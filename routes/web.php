<?php

use App\Http\Controllers\AddController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\UserListController;
use App\Http\Middleware\AuthStatusMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([AuthStatusMiddleware::class])->group(
    function () {
        
        Route::get('/userlist', [UserListController::class, 'index'])->name('userList');
        Route::get('/userprofile', [ProfileController::class, 'index'])->name('userProfile');
        Route::get('/', [IndexController::class, 'index'])->name('index');
        Route::get('/add', [AddController::class, 'index'])->name('add');
        Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
    }
);
Route::get('/signup', [SignupController::class, 'index'])->name('signup');
Route::post('/signup', [SignupController::class, 'register'])->name('signup.post');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');


