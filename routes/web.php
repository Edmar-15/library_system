<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BooklistController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RatingController;

Route::get('/', function () {
    return view('welcome');
})->name('show.welcome');

Route::get('/librarysystem/register', [AuthController::class, 'showRegister'])->name('show.register');
Route::get('/librarysystem/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('/librarysystem/register', [AuthController::class, 'register'])->name('register');
Route::post('/librarysystem/login', [AuthController::class, 'login'])->name('login');
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');

Route::post('/librarysystem/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/librarysystem/profile', [ProfileController::class, 'index'])->name('show.profile');
    Route::put('/librarysystem/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/librarysystem/dashboard', [UserController::class, 'index'])->name('show.home');
    Route::get('/librarysystem/about', [AboutController::class, 'index'])->name('show.about');
    
    Route::get('/librarysystem/api/about', [AboutController::class, 'getAboutData'])->name('api.about.data');

    Route::get('/books/{book}/read', [BookController::class, 'readContent'])->name('books.readbook');
    Route::get('/books/{book}/download', [BookController::class, 'downloadContent'])->name('books.download');
    Route::post('/books/{book}/bookmark', [BookmarkController::class, 'save'])->name('books.bookmark');
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');

    Route::get('/booklists', [BooklistController::class, 'index'])->name('booklists.index');
    Route::get('/booklists/stats', [BooklistController::class, 'stats'])->name('booklists.stats');
    Route::resource('books', BookController::class);
    Route::post('/booklists', [BooklistController::class, 'store'])->name('booklists.store');
    Route::put('/booklists/{booklist}', [BooklistController::class, 'update'])->name('booklists.update');
    Route::delete('/booklists/{booklist}', [BooklistController::class, 'destroy'])->name('booklists.destroy');
    Route::resource('staff', StaffController::class);
    Route::resource('news', NewsController::class);
    Route::post('/books/{book}/rate', [RatingController::class, 'rate']);
});

Route::middleware(['auth', 'role:librarian'])->group(function () {
    Route::get('/librarysystem/about/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('/librarysystem/about/update', [AboutController::class, 'update'])->name('about.update');
    Route::patch('/about/{id}', [AboutController::class, 'updateJson'])->name('api.about.update');
});

Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('librarysystem/admin', [AdminUserController::class, 'index'])->name('show.admin');
    Route::patch('librarysystem/admin/users/{user}', [AdminUserController::class, 'updateRole'])->name('admin.users.update');
});