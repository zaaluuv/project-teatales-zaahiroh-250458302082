<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\RandomQuote;
use Illuminate\Http\Request;
use App\Models\Stat;          
use Illuminate\Support\Number;
use App\Livewire\ExploreStories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\ProfileController;

Route::get('/', function (Request $request) {
    if (Auth::check() && Auth::user()->status === 'blocked') {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('blocked_message', 'Akun Anda telah ditangguhkan.');
    }

    $stat = Stat::firstOrCreate([], ['total_visits' => 0]);
    $stat->increment('total_visits');
    
    $userCount = User::count();
    $postCount = Post::where('status', 'published')->count();

    $randomQuote = RandomQuote::inRandomOrder()->first();

    return view('welcome', [
        'activeUsers'      => $userCount < 1000 ? $userCount : Number::abbreviate($userCount, 1),
        'publishedStories' => $postCount < 1000 ? $postCount : Number::abbreviate($postCount, 1),
        'monthlyVisitors'  => $stat->total_visits < 1000 ? $stat->total_visits : Number::abbreviate($stat->total_visits, 1),
        'quote'            => $randomQuote, 
    ]);
})->name('home');

// HALAMAN EXPLORE
Route::get('/explore', ExploreStories::class)->name('explore');

// DETAIL POSTINGAN
Route::get('/posts/{post:slug}', function (Post $post) {
    $sessionKey = 'viewed_post_' . $post->id;

    if (!session()->has($sessionKey)) {
        $post->increment('view_count');
        session()->put($sessionKey, true);
    }

    return view('posts.show', ['post' => $post]);
})->name('post.show');

// HALAMAN PROFIL
Route::get('/profile/{user:username}', function (User $user) {
    $activeTab = request()->query('tab', 'posts');
    
    $isOwner = Auth::id() === $user->id;

    if (in_array($activeTab, ['drafts', 'saved', 'liked']) && !$isOwner) {
        abort(403, 'Anda tidak memiliki akses ke tab ini.');
    }
    
    return view('profile.show', [
        'user' => $user,
        'activeTab' => $activeTab
    ]);
})->name('profile.show');

// AREA MEMBER
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/settings', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/post/create', function () {
        return view('posts.create');
    })->name('posts.create');

    Route::get('/post/{post}/edit', function (Post $post) {
        if (Auth::id() !== $post->user_id) abort(403); 

        return view('posts.edit', ['post' => $post]);
    })->name('posts.edit');

    Route::delete('/posts/{post}', function (Post $post) {
        if (Auth::id() !== $post->user_id) {
            abort(403, 'Anda tidak berhak menghapus postingan ini.');
        }
        $post->delete();
        return redirect()->route('profile.show', Auth::user()->username);
    })->name('posts.destroy');
});

require __DIR__.'/auth.php';