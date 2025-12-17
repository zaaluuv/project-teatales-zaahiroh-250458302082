<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use App\Models\Category; 

class ShowPosts extends Component
{
    use WithPagination;

    public $search = '';
    public $category = ''; 

    public function updatedSearch() { $this->resetPage(); }
    public function updatedCategory() { $this->resetPage(); }

    public function render()
    {
        $categories = Category::orderBy('name')->get();

        $posts = Post::query()
            ->with(['user', 'category'])
            ->where('status', 'published')
            
            ->when($this->category, function ($query) {
                $query->where('category_id', $this->category);
            })

            ->when($this->search, function ($query) {
                $query->where(function($q) {
                    $q->where('slug', 'like', '%' . $this->search . '%')
                        ->orWhere('content', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate(9);

        return view('livewire.show-posts', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }
}