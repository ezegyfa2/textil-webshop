<?php

use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

    Route::get('forgot-password', [PasswordController::class, 'forgotPassword'])
        ->name('forgot-password');
    Route::post('forgot-password', [PasswordController::class, 'sendResetLink'])
        ->name('send-password-link');
});

Route::middleware('auth')->group(function () {
    /*Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');*/
    
    Route::get('profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::post('profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::get('profile/change-password', [PasswordController::class, 'edit'])
        ->name('profile.password.edit');
    Route::post('profile/change-password', [PasswordController::class, 'update'])
        ->name('profile.password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
