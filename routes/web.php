<?php

use App\Models\Post;
use App\Models\User;
use App\Models\RandomQuote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/posts/{post:slug}', function (Post $post) {
    $post->view_count++;
    $post->save();

    return view('posts.show', ['post' => $post]);
})->name('post.show');

Route::get('/profile/{user:username}', function (User $user) {
    return view('profile.show', ['user' => $user]);
})->name('profile.show');

Route::get('/post/create', function () {
    return view('posts.create');
})->middleware('auth')->name('post.create');

Route::get('/post/{post}/edit', function (Post $post) {
    if (Auth::id() !== $post->user_id) {
        abort(403);
    }
    return view('posts.edit', ['post' => $post]);
})->middleware('auth')->name('post.edit');

Route::get('/', function () {
    $quote = RandomQuote::inRandomOrder()->first();
    
    return view('welcome', ['quote' => $quote]);
})->name('home');

require __DIR__.'/auth.php';
