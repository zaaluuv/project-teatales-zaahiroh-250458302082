<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class ExploreStories extends Component
{
    public $search = '';
    public $filterType = 'all';
    public $activeTab = 'posts';

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    #[Layout('components.app-layout')]
    public function render()
    {
        $posts = [];
        $users = [];

        if ($this->activeTab === 'users') {
            $users = User::query()
                ->where('username', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%')
                ->latest()
                ->get();
        } else {
            $posts = Post::query()
                ->with(['user', 'category'])
                ->where('status', 'published')
                ->where(function (Builder $query) {
                    if ($this->search) {
                        switch ($this->filterType) {
                            case 'title':
                                $query->where('slug', 'like', '%' . $this->search . '%');
                                break;
                            case 'content':
                                $query->where('content', 'like', '%' . $this->search . '%');
                                break;
                            case 'category':
                                $query->whereHas('category', function (Builder $q) {
                                    $q->where('name', 'like', '%' . $this->search . '%');
                                });
                                break;
                            default: // 'all'
                                $query->where('slug', 'like', '%' . $this->search . '%')
                                        ->orWhere('content', 'like', '%' . $this->search . '%')
                                        ->orWhereHas('category', function (Builder $q) {
                                            $q->where('name', 'like', '%' . $this->search . '%');
                                        });
                                break;
                        }
                    }
                })
                ->latest()
                ->get();
        }

        return view('livewire.explore-stories', [
            'posts' => $posts,
            'users' => $users
        ]);
    }
}