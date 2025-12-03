<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/librarysystem/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::get('/librarysystem/register', [AuthController::class, 'showRegister'])->name('show.register');
Route::post('/librarysystem/login')->name('login');
Route::post('/librarysystem/register')->name('register');
