<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;

Route::middleware('guest')->group(function () {
        Route::get('register', [RegisteredUserController::class, 'create']);

        Route::post('register', [RegisteredUserController::class, 'store'])
                ->name('register');

        Route::get('login', [AuthenticatedSessionController::class, 'create']);
        
        Route::post('login', [AuthenticatedSessionController::class, 'store'])
                ->name('login');
});

Route::middleware('auth')->group(function () {
        Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

        Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

