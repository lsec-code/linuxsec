<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('/tutorial', 'tutorial')->name('tutorial'); // You might need to create this view later
Route::redirect('/whatsapp-channel', 'https://www.whatsapp.com/channel/0029VbBOnyh7oQhauj5tmD3C'); 
Route::redirect('/contact-admin', 'https://wa.me/639976677899');

Route::middleware('auth')->group(function () {
    Route::get('/tools', function () {
        return view('tools'); // Placeholder for tools page
    })->name('tools');
    
    Route::view('/social-services', 'social-services')->name('social-services');
});

// Auth Routes
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/login', function () {
    return redirect()->route('home');
})->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', function () {
    return redirect()->route('home');
});

// Password Reset Routes
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Route::get('/promote-admin/{username}', function ($username) {
//     $user = \App\Models\User::where('username', $username)->firstOrFail();
//     $user->update(['is_admin' => true]);
//     return "User {$username} is now an Admin!";
// });

Route::get('/api/stats', [\App\Http\Controllers\StatsController::class, 'getStats']);

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/settings', [\App\Http\Controllers\AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/settings', [\App\Http\Controllers\AdminController::class, 'updateSettings'])->name('admin.settings.update');

    Route::get('/captcha', [\App\Http\Controllers\AdminController::class, 'captcha'])->name('admin.captcha');
    
    Route::get('/cards', [\App\Http\Controllers\AdminController::class, 'cards'])->name('admin.cards');
    Route::post('/cards', [\App\Http\Controllers\AdminController::class, 'storeCard'])->name('admin.cards.store');
    Route::put('/cards/{card}', [\App\Http\Controllers\AdminController::class, 'updateCard'])->name('admin.cards.update');
    Route::delete('/cards/{card}', [\App\Http\Controllers\AdminController::class, 'deleteCard'])->name('admin.cards.delete');
});

