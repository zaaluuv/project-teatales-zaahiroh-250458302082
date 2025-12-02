<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class FollowButton extends Component
{
    public User $author;
    public $isFollowing = false;

    public function mount(User $author)
    {
        $this->author = $author;

        if (Auth::check()) {
            
            /** @var User $user */
            $user = Auth::user();
            
            $this->isFollowing = $user->following()->where('following_id', $this->author->id)->exists();
        }
    }

    public function toggleFollow()
    {
        if (Auth::guest()) {
            return $this->redirect(route('login'), navigate: true);
        }

        if (Auth::id() === $this->author->id) {
            return; 
        }
        
        /** @var User $user */ 
        $user = Auth::user();

        $user->following()->toggle($this->author->id);

        $this->isFollowing = !$this->isFollowing;
    }

    public function render()
    {
        return view('livewire.follow-button');
    }
}