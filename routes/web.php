<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Blogpost;
use App\Models\User;

Route::get('/', function () {
$posts = [];

if (auth()->check()) {
    $posts = auth()->user()->userCoolPost()->latest()->get();
}
    // $post = Blogpost::where('user_id', auth())->get();
    return view('home', ['blogposts' => $posts]);
});

Route::post('/register',[UserController::class, 'register']);
Route::post('/logout',[UserController::class, 'logout']);
Route::post('/login',[UserController::class, 'login']);

// create post
Route::post('/post',[PostController::class, 'createPost']);

// edit post
Route::get('/edit-post/{blogpost}',[PostController::class, 'showEditScreen']);
Route::put('/edit-post/{blogpost}',[PostController::class, 'updatePost']);

// delete post
Route::delete('/delete-post/{blogpost}',[PostController::class, 'deletePost']);



