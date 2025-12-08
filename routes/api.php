<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Profile;

Route::middleware('auth:sanctum')->get('/librarysystem/profile/api', [ProfileController::class, 'getProfileApi']);


Route::apiResource('users', ProfileController::class);

Route::get('/about', [AboutController::class, 'getAboutData']);

Route::patch('/about/{id}', [AboutController::class, 'updateJson'])->name('api.about.update');
