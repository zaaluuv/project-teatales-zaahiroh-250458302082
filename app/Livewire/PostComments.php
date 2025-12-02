<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class PostComments extends Component
{
    use WithPagination;

    public Post $post;
    public $content = '';

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function postComment()
    {
        if (Auth::guest()) {
            return $this->redirect(route('login'), navigate: true);
        }

        $this->validate([
            'content' => 'required|min:3|max:1000',
        ]);

        $this->post->comments()->create([
            'user_id' => Auth::id(),
            'content' => $this->content,
        ]);

        $this->content = '';
        session()->flash('message', 'Comment posted!');
        
        $this->resetPage(); 
    }

    public function render()
    {
        return view('livewire.post-comments', [
            'comments' => $this->post->comments()->with('user')->latest()->paginate(10)
        ]);
    }
}