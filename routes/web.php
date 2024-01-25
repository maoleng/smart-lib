<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\BookInstanceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\SiteController;
use App\Http\Middleware\MustBeAdmin;
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

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => [MustLogin::class, MustBeAdmin::class]], static function () {
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
    });
    Route::group(['prefix' => 'book', 'as' => 'book.'], function () {
        Route::get('/', [BookController::class, 'index'])->name('index');
        Route::get('/{book}', [BookController::class, 'show'])->name('show');
        Route::post('/', [BookController::class, 'store'])->name('store');
        Route::put('/{book}', [BookController::class, 'update'])->name('update');
        Route::delete('/{book}', [BookController::class, 'destroy'])->name('destroy');
    });
    Route::group(['prefix' => 'book-instance', 'as' => 'book-instance.'], function () {
        Route::post('/', [BookInstanceController::class, 'store'])->name('store');
        Route::post('/return/{book_instance}', [BookInstanceController::class, 'returnBook'])->name('return');
        Route::delete('/{book_instance}', [BookInstanceController::class, 'destroy'])->name('destroy');
    });

});

Route::post('/borrow/{book}', [BorrowController::class, 'store'])->name('borrow.store');

Route::get('/{slug}', [\App\Http\Controllers\BookController::class, 'show'])->name('book.show');
