<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
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

Route::get('/librarysystem/dashboard', [UserController::class, 'index'])->name('show.home');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkForm'])->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
