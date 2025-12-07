<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->get('/librarysystem/profile/api', [ProfileController::class, 'getProfileApi']);



