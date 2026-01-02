<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Captcha Validation Helper
    private function validateCaptcha(Request $request)
    {
        $provider = \App\Models\Setting::where('key', 'captcha_provider')->value('value');
        
        if (!$provider || $provider === 'none') {
            return true;
        }

        $secret = \App\Models\Setting::where('key', 'captcha_secret_key')->value('value');
        
        if ($provider === 'recaptcha') {
            $token = $request->input('g-recaptcha-response');
            if (!$token) return false;
            
            $verify = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$token}"), true);
            return $verify['success'] ?? false;
        }

        if ($provider === 'turnstile') {
            $token = $request->input('cf-turnstile-response');
            if (!$token) return false;

            // Turnstile requires POST request
            $data = ['secret' => $secret, 'response' => $token];
            $options = [
                'http' => [
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data)
                ]
            ];
            $context  = stream_context_create($options);
            $verify = json_decode(file_get_contents("https://challenges.cloudflare.com/turnstile/v0/siteverify", false, $context), true);
            return $verify['success'] ?? false;
        }

        return true;
    }

    public function register(Request $request)
    {
        if (!$this->validateCaptcha($request)) {
             return response()->json(['errors' => ['captcha' => ['Captcha validasi gagal. Silakan coba lagi.']]], 422);
        }

        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'min:3', 'regex:/^[a-zA-Z0-9.]+$/', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'username' => $request->username,
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return response()->json(['message' => 'Registration successful', 'redirect' => route('home')]);
    }

    public function login(Request $request)
    {
        if (!$this->validateCaptcha($request)) {
             return response()->json(['errors' => ['username' => ['Captcha validasi gagal.']]], 422);
        }

        $credentials = $request->only('username', 'password');

        $key = 'login:' . $request->ip();

        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($key);
            return response()->json([
                'errors' => ['username' => ["Terlalu banyak percobaan."]],
                'retry_after' => $seconds
            ], 429);
        }

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

        \Illuminate\Support\Facades\RateLimiter::hit($key, 10);
        
        $attempts = \Illuminate\Support\Facades\RateLimiter::attempts($key);
        
        return response()->json([
            'errors' => ['username' => ["Username atau password salah. (Percobaan ke-{$attempts})"]]
        ], 422);
    }

    public function forgotPassword(Request $request)
    {
        if (!$this->validateCaptcha($request)) {
             return response()->json(['errors' => ['email' => ['Captcha validasi gagal.']]], 422);
        }

        $request->validate(['email' => 'required|email']);
        
        $key = 'forgot:' . $request->ip();

        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($key, 3)) {
             $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($key);
             return response()->json([
                'errors' => ['email' => ["Terlalu banyak percobaan."]],
                'retry_after' => $seconds
            ], 429);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
             \Illuminate\Support\Facades\RateLimiter::hit($key, 10);
             $attempts = \Illuminate\Support\Facades\RateLimiter::attempts($key);
             return response()->json([
                'errors' => ['email' => ["Kami tidak dapat menemukan pengguna dengan alamat email tersebut. (Percobaan ke-{$attempts})"]]
            ], 422);
        }

        $token = \Illuminate\Support\Str::random(60);
        \Illuminate\Support\Facades\DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => Hash::make($token),
                'created_at' => now()
            ]
        );

        $link = route('password.reset', ['token' => $token, 'email' => $request->email]);
        
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

        $record = \Illuminate\Support\Facades\DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$record || !Hash::check($request->token, $record->token)) {
             return response()->json(['errors' => ['email' => ['Token reset password tidak valid atau kedaluwarsa.']]], 422);
        }

        $user = User::where('email', $request->email)->first();
        $user->forceFill([
            'password' => Hash::make($request->password)
        ])->save();

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
