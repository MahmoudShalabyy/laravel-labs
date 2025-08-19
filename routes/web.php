<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', '/posts');
Route::get('/posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');
Route::patch('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
Route::delete('/posts/{id}/forceDelete', [PostController::class, 'forceDelete'])->name('posts.forceDelete');


Route::resource('posts', PostController::class);
Route::post('/posts/{post}/comments', [PostController::class, 'addComment'])->name('posts.comments.store');
 

