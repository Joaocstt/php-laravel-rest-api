<?php

use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'api'], function () {
    // Routes users
    Route::get('/users', [UserController::class, 'index'])->name('posts');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('show');
    Route::post('/users/create', [UserController::class, 'store'])->name('store');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/users/delete/{id}', [UserController::class, 'delete'])->name('delete');

    // Routes Posts
    Route::get('/posts', [PostController::class, 'index'])->name('posts');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('show');
    Route::post('/posts/create', [PostController::class, 'store'])->name('store');
    Route::put('/posts/update/{id}', [PostController::class, 'update'])->name('update');
    Route::delete('/posts/delete/{id}', [PostController::class, 'delete'])->name('delete');
});
