<?php
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\AdminPasswordController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;



Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('admin.register');

    Route::post('register', [RegisteredUserController::class, 'store'])->name('adminRegister');

    Route::get('login', [LoginController::class, 'create'])
                ->name('admin.login');

    Route::post('login', [LoginController::class, 'store']);

});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
       // Custom routes
    Route::get('/posts/manage', [PostsController::class, 'managePosts'])->name('posts.manage');
    Route::get('/posts/trash', [PostsController::class, 'trash'])->name('posts.trash');
Route::get('/posts/restore/{post}', [PostsController::class, 'restore'])->name('posts.restore');
Route::get('/posts/sort-by-date', [PostsController::class, 'sortByDate'])->name('posts.sort-by-date');
Route::post('/posts/forceDelete/{post}', [PostsController::class, 'forceDelete'])->name('posts.forceDelete');
Route::get('/posts/allPosts', [PostsController::class, 'allPosts'])->name('posts.allPosts');
Route::get('/profile', [AdminProfileController::class, 'edit'])->name('adminProfile.edit');
Route::patch('/profile', [AdminProfileController::class, 'update'])->name('adminProfile.update');
Route::delete('/profile', [AdminProfileController::class, 'destroy'])->name('adminProfile.destroy');
// Define resource routes for the posts resource
Route::resource('posts', PostsController::class);
Route::put('password', [AdminPasswordController::class, 'update'])->name('admin.password.update');
    Route::post('logout', [LoginController::class, 'destroy'])
                ->name('admin.logout');
                Route::get('/chart-data', [PostsController::class, 'getData'])->name('chart.data');

});