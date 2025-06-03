<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

     Route::get('login', [AccountController::class, 'login'])
         ->name('login');

     Route::post('login', [AccountController::class, 'loginPost']);

     Route::get('forgot_password', [AccountController::class, 'forgotPassword'])
         ->name('forgotPassword');

     Route::post('recovery-password', [AccountController::class, 'recoveryPassword'])
         ->name('recoveryPassword');
     
     Route::get('/reset-password/{token}', [AccountController::class, 'resetPassword'])
         ->name('password.reset');

     Route::post('/reset-password', [AccountController::class, 'resetPasswordPost'])
         ->name('password.update');
});

Route::middleware('auth')->group(function () {

    Route::post('logout', [AccountController::class, 'logout'])
         ->name('logout');

    Route::get('/profile/edit', [AccountController::class, 'edit'])
         ->name('profile.edit');    

    Route::put('/profile/update', [AccountController::class, 'update'])
         ->name('profile.update');   
         
    Route::get('/profile/change-password', [AccountController::class, 'changePassword'])
         ->name('profile.changePassword');    

    Route::patch('/profile/update-password', [AccountController::class, 'updatePassword'])
         ->name('profile.updatePassword');    
});
