<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Profile;

Route::middleware('auth:sanctum')->get('/librarysystem/profile/api', [ProfileController::class, 'getProfileApi']);


