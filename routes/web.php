<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AdministerController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[ShopController::class,'index']);

Route::post('/search',[ShopController::class,'search'])
        ->name('search');
        
        Route::get('/detail/{id}',[ShopController::class,'detail'])
        ->name('detail');
        
        Route::post('/like/{id}',[ShopController::class,'like'])
        ->name('like');
        
        Route::post('/dis_like/{id}',[ShopController::class,'dis_like'])
        ->name('dislike');
        
        Route::post('/reserve',[ShopController::class,'reserve'])
        ->middleware(['auth'])->name('reserve');
        
        Route::post('/review',[ShopController::class,'review'])
        ->name('review');
        
        Route::post('/update/{id}',[ShopController::class,'update'])
        ->name('update');
        
        Route::post('/delete/{id}',[ShopController::class,'delete'])
        ->name('delete');
        
        Route::get('/mypage',[Usercontroller::class,'mypage'])
                ->name('mypage');
        
        Route::get('/dashboard', function () {
                return view('dashboard');
        })->middleware(['auth'])->name('dashboard');
        
        
require __DIR__.'/auth.php';

Route::prefix('admin')->name('admin.')->group(function(){
        require __DIR__.'/admin.php';
});

Route::get('/test',[MailController::class,'remind_mail']);