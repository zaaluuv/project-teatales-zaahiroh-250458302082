<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Reshare;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PostStats extends Component
{
    public Post $post;

    public $isLiked = false;
    public $likeCount = 0;
    
    public $isFavorited = false;
    
    public $isReshared = false;
    public $reshareCount = 0;

    protected $listeners = ['commentPosted' => '$refresh'];

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->initStats();
    }

    public function initStats()
    {
        $userId = Auth::id();

        $this->likeCount = $this->post->likes()->count();
        $this->isLiked = $userId ? $this->post->likes()->where('user_id', $userId)->exists() : false;

        $this->isFavorited = $userId ? $this->post->favorites()->where('user_id', $userId)->exists() : false;

        $this->reshareCount = Reshare::where('post_id', $this->post->id)->count();
        
        $this->isReshared = $userId ? Reshare::where('user_id', $userId)
                                                ->where('post_id', $this->post->id)
                                                ->exists() : false;
    }

    public function toggleReshare()
    {
        if (Auth::guest()) {
            return $this->redirect(route('login'), navigate: true);
        }

        $userId = Auth::id();
        $postId = $this->post->id;

        $existingReshare = Reshare::where('user_id', $userId)
                                    ->where('post_id', $postId)
                                    ->first();

        if ($existingReshare) {
            $existingReshare->delete(); 
            
            $this->isReshared = false;
            $this->reshareCount--;

        } else {
            Reshare::create([
                'user_id' => $userId,
                'post_id' => $postId
            ]); 
            
            $this->isReshared = true;
            $this->reshareCount++;
            
            session()->flash('stat_message', 'Berhasil dibagikan ulang!');
        }
    }

    public function toggleLike()
    {
        if (Auth::guest()) return $this->redirect(route('login'), navigate: true);

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

    public function toggleFavorite()
    {
        if (Auth::guest()) return $this->redirect(route('login'), navigate: true);

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
        return view('livewire.post-stats');
    }
}