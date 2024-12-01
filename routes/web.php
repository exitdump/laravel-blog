<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::resource('users', UserController::class)->except('show');
    Route::resource('blogs', BlogController::class);
    Route::resource('categories', CategoryController::class);
});

// Author Routes
Route::middleware(['auth', 'author'])->prefix('author')->as('author.')->group(function () {
    Route::resource('blogs', \App\Http\Controllers\Author\BlogController::class);
});

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    Route::get('/{category}/{blog}', [DashboardController::class,'single'])
    ->where(['category' => '[a-zA-Z0-9-_]+', 'blog' => '[a-zA-Z0-9-_]+'])->name('single');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
