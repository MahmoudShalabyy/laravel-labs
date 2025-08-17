<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', '/posts');
Route::resource('posts', PostController::class);
Route::post('/posts/{post}/comments', [PostController::class, 'addComment'])
    ->name('posts.comments.store');