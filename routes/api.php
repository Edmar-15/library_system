<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Profile;

Route::middleware('auth:sanctum')->get('/librarysystem/profile/api', [ProfileController::class, 'getProfileApi']);

Route::middleware('auth')->group(function () {
    Route::apiResource('users', ProfileController::class);

    Route::get('/about', [AboutController::class, 'getAboutData']);

    Route::patch('/about/{id}', [AboutController::class, 'updateJson'])->name('api.about.update');

    Route::apiResource('book', BookController::class);

    Route::get('/books', [BookController::class, 'apiIndex']);

    Route::get('/books/{book}', [BookController::class, 'apiShow']);

    Route::patch('/books/{book}/rating', [BookController::class, 'updateRating']);
});

