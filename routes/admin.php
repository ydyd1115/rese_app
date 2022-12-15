<?php

use App\Http\Controllers\AdministerController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);
                
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');


    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('admin_ope',[AdministerController::class,'admin_ope'])
                ->name('admin_ope');
    
    Route::post('add_manager',[AdministerController::class,'add_manager'])
                ->name('add_manager');
    
    Route::post('update_manager',[AdministerController::class,'update_manager'])
                ->name('update_manager');
    
    Route::get('management',[AdministerController::class,'management'])
                ->name('management');
    
    Route::post('update_shop',[AdministerController::class,'update_shop'])
                ->name('update_shop');
    
    Route::post('img_up',[AdministerController::class,'img_up'])
                ->name('img_up');
    
    Route::post('update_reserve',[AdministerController::class,'update_reserve'])
                ->name('update_reserve');
    
    Route::post('delete_reserve',[AdministerController::class,'delete_reserve'])
                ->name('delete_reserve');
    
    Route::get('different_role',[AdministerController::class,'different_role'])
                ->name('different_role');

    Route::post('/send_mail', [MailController::class,'send_mail'])
                ->name('send_mail');
    
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
                
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth:admin')
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    
});
