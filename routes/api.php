<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', ProfileController::class);

Route::get('/about', [AboutController::class, 'getAboutData']);

Route::patch('/about/{id}', [AboutController::class, 'updateJson'])->name('api.about.update');