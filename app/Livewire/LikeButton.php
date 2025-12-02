<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeButton extends Component
{
    public Post $post;
    public $likeCount;
    public $isLiked;

    public function mount()
    {
        $this->likeCount = $this->post->likes()->count();
        $this->isLiked = Auth::check() ? $this->post->likes()->where('user_id', Auth::id())->exists() : false;
    }

    public function toggleLike()
    {
        if (Auth::guest()) {
            return $this->redirect(route('login'), navigate: true);
        }

        if ($this->isLiked) {
            $this->post->likes()->where('user_id', Auth::id())->delete();
            $this->isLiked = false;
            $this->likeCount--;
        } else {
            $this->post->likes()->create(['user_id' => Auth::id()]);
            $this->isLiked = true;
            $this->likeCount++;
        }
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}