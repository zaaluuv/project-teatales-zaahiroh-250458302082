<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithPagination;
    public $search = '';

    public function render()
    {
        $posts = Post::where('status', 'published')
            ->where('title', 'like', '%'.$this->search.'%')
            ->latest()
            ->paginate(10);

        return view('livewire.show-posts', ['posts' => $posts]);
    }
}
