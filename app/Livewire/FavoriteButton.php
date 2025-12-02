<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class FavoriteButton extends Component
{
    public Post $post;
    public $isFavorited = false;

    public function mount(Post $post)
    {
        $this->post = $post;
        
        if (Auth::check()) {
            $this->isFavorited = $this->post->favorites()->where('user_id', Auth::id())->exists();
        }
    }

    public function toggleFavorite()
    {
        if (Auth::guest()) {
            return $this->redirect(route('login'), navigate: true);
        }

        if ($this->isFavorited) {
            $this->post->favorites()->where('user_id', Auth::id())->delete();
            $this->isFavorited = false;
        } else {
            $this->post->favorites()->create(['user_id' => Auth::id()]);
            $this->isFavorited = true;
        }
    }

    public function render()
    {
        return view('livewire.favorite-button');
    }
}