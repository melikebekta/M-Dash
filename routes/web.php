<?php

use App\Http\Controllers\AddController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\InvoiceListController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignupController;

use App\Http\Middleware\AuthStatusMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([AuthStatusMiddleware::class])->group(
    function () {


        Route::get("/invoicelist", [InvoiceListController::class, "index"])->name('invoiceList');
        Route::post('/invoicelist', [InvoiceListController::class, 'delete'])->name('invoiceList.delete');
        Route::get('/userprofile', [ProfileController::class, 'index'])->name('userProfile');
        Route::post('/userprofile', [ProfileController::class, 'update'])->name('userProfile.post');
        Route::get('/', [IndexController::class, 'index'])->name('index');
        Route::get('/add', [AddController::class, 'index'])->name('add');
        Route::post('/add', [AddController::class, 'store'])->name('add.post');
        Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
    }
);
Route::get('/signup', [SignupController::class, 'index'])->name('signup');
Route::post('/signup', [SignupController::class, 'register'])->name('signup.post');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');


