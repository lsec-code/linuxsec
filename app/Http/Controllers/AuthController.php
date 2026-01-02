<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'min:3', 'regex:/^[a-zA-Z0-9.]+$/', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'], // Added confirmed
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'username' => $request->username,
            'name' => $request->username, // Default name to username
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return response()->json(['message' => 'Registration successful', 'redirect' => route('home')]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $key = 'login:' . $request->ip();

        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($key);
            return response()->json([
                'errors' => ['username' => ["Terlalu banyak percobaan."]],
                'retry_after' => $seconds
            ], 429);
        }

        // Validation for login fields
        $validator = Validator::make($credentials, [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (Auth::attempt($credentials)) {
            \Illuminate\Support\Facades\RateLimiter::clear($key);
            $request->session()->regenerate();
            return response()->json(['message' => 'Login successful', 'redirect' => route('home')]);
        }

        \Illuminate\Support\Facades\RateLimiter::hit($key, 10); // 10 seconds decay
        
        $attempts = \Illuminate\Support\Facades\RateLimiter::attempts($key);
        $remaining = 3 - $attempts + 1; // +1 because we just hit it but want to show current fail count
        
        return response()->json([
            'errors' => ['username' => ["Username atau password salah. (Percobaan ke-{$attempts})"]]
        ], 422);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        $key = 'forgot:' . $request->ip();

        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($key, 3)) {
             $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($key);
             return response()->json([
                'errors' => ['email' => ["Terlalu banyak percobaan."]],
                'retry_after' => $seconds
            ], 429);
        }

        // We will simulate sending email for now since we are in local environment without SMTP
        // In production, use: $status = Password::sendResetLink($request->only('email'));

        $user = User::where('email', $request->email)->first();

        if (!$user) {
             \Illuminate\Support\Facades\RateLimiter::hit($key, 10); // 10 seconds decay
             $attempts = \Illuminate\Support\Facades\RateLimiter::attempts($key);
             return response()->json([
                'errors' => ['email' => ["Kami tidak dapat menemukan pengguna dengan alamat email tersebut. (Percobaan ke-{$attempts})"]]
            ], 422);
        }

        // Create token
        $token = \Illuminate\Support\Str::random(60);
        \Illuminate\Support\Facades\DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => Hash::make($token),
                'created_at' => now()
            ]
        );

        // In a real app, send this link via email
        $link = route('password.reset', ['token' => $token, 'email' => $request->email]);
        
        // Return the link in the response for testing purposes (visible in DevTools or we can show it in a Toast for demo)
        return response()->json([
            'message' => 'Link reset password berhasil dikirim (Simulasi).',
            'debug_link' => $link 
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed',
        ]);

        // Verify token
        $record = \Illuminate\Support\Facades\DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$record || !Hash::check($request->token, $record->token)) {
             return response()->json(['errors' => ['email' => ['Token reset password tidak valid atau kedaluwarsa.']]], 422);
        }

        // Update password
        $user = User::where('email', $request->email)->first();
        $user->forceFill([
            'password' => Hash::make($request->password)
        ])->save();

        // Delete token
        \Illuminate\Support\Facades\DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return response()->json(['message' => 'Password berhasil direset! Silakan login.']);
    }

    public function showResetForm(Request $request)
    {
        return view('auth.reset-password', ['token' => $request->token, 'email' => $request->email]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
