<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiteController;
use App\Http\Middleware\MustNotLogin;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'index'])->name('index');

Route::group(['prefix' => 'auth', 'as' => 'auth.'], static function () {
    Route::group(['middleware' => MustNotLogin::class], static function () {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::get('/register', [AuthController::class, 'register'])->name('register');
        Route::get('/forget-password', [AuthController::class, 'forgetPassword'])->name('forget-password');
        Route::post('/login-process', [AuthController::class, 'loginProcess'])->name('login-process');
        Route::post('/register-process', [AuthController::class, 'registerProcess'])->name('register-process');
    });
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

});
