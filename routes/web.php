<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\profileController;



Route::get('/threads', function () {
    return view('threads.index');
});
Route::get('/threads', [ThreadController::class, 'index'])->name('threads.index');
Route::get('/threads/create', [ThreadController::class, 'create'])->name('threads.create');
Route::post('/threads', [ThreadController::class, 'store'])->name('threads.store');
Route::get('threads/{thread}', [ThreadController::class, 'show'])->name('threads.show');

Route::get('/threads/{thread}/edit', [ThreadController::class, 'edit'])->name('threads.edit');
Route::put('/threads/{thread}', [ThreadController::class, 'update'])->name('threads.update');
Route::delete('/threads/{thread}', [ThreadController::class, 'destroy'])->name('threads.destroy');
Route::post('/threads/{thread}/posts', [PostController::class, 'store'])
    ->name('threads.posts.store');
    Route::post('/threads/{thread}/posts', [PostController::class, 'store'])
    ->name('posts.store');



Route::get('/threads/{thread}/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/threads/{thread}/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
// Auth Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('users/{user}/threads', [UserController::class, 'threads'])->name('users.threads');
Route::get('users/{user}/posts', [UserController::class, 'posts'])->name('users.posts');
Route::get('users/{user}', [UserController::class,'show'])->name('users.show');


Route::get('/users/profile/{user}', [UserController::class, 'profile'])->name('users.profile');

Route::get('/profile', [profileController::class, 'show'])->name('profile.show');
