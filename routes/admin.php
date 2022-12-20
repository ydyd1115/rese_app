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
Route::get('register', [RegisteredUserController::class, 'create']);
        
        Route::post('register', [RegisteredUserController::class, 'store'])
                ->name('register');
        
        Route::get('login', [AuthenticatedSessionController::class, 'create']);
        
        Route::post('login', [AuthenticatedSessionController::class, 'store'])
                ->name('login');
});

Route::middleware('auth:admin')->group(function () {        
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                        ->name('logout');
        Route::get('admin_ope',[AdministerController::class,'admin_ope'])
                ->name('admin_ope');
        
        Route::post('add_manager',[AdministerController::class,'add_manager'])
                ->name('add_manager');
        
        Route::post('update_manager',[AdministerController::class,'update_manager'])
                ->name('update_manager');
                
        Route::post('delete_manager',[AdministerController::class,'delete_manager'])
                ->name('delete_manager');
        
        Route::get('management',[AdministerController::class,'management'])
                ->name('management');
                
        Route::get('different_role',[AdministerController::class,'different_role'])
                ->name('different_role');
                
        Route::post('update_shop',[AdministerController::class,'update_shop'])
                ->name('update_shop');
        
        Route::post('img_up',[AdministerController::class,'img_up'])
                ->name('img_up');
        
        Route::post('update_reserve',[AdministerController::class,'update_reserve'])
                ->name('update_reserve');
        
        Route::post('delete_reserve',[AdministerController::class,'delete_reserve'])
                ->name('delete_reserve');

        Route::post('/send_mail', [MailController::class,'send_mail'])
                ->name('send_mail');
});
