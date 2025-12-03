<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/librarysystem/register', [AuthController::class, 'showRegister'])->name('show.register');

Route::get('/librarysystem/login', [AuthController::class, 'showLogin'])->name('show.login');

Route::post('/librarysystem/register', [AuthController::class, 'register'])->name('register');

Route::post('/librarysystem/login', [AuthController::class, 'login'])->name('login');

Route::post('/librarysystem/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/librarysystem/home', [UserController::class, 'index'])->name('show.home');
