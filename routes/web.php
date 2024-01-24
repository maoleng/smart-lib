<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\MustLogin;
use App\Http\Middleware\MustNotLogin;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'index'])->name('index');

Route::group(['prefix' => 'auth', 'as' => 'auth.'], static function () {
    Route::group(['middleware' => MustNotLogin::class], static function () {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::get('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/login-process', [AuthController::class, 'loginProcess'])->name('login-process');
        Route::post('/register-process', [AuthController::class, 'registerProcess'])->name('register-process');
    });
    Route::get('/logout', [AuthController::class, 'logout'])->middleware(MustLogin::class)->name('logout');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => [MustLogin::class]], static function () {
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
    });
});

Route::post('/borrow/{book}', [BorrowController::class, 'store'])->name('borrow.store');

Route::get('/{slug}', [BookController::class, 'show'])->name('book.show');
