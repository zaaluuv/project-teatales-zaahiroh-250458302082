<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AuthorsToFollow extends Component
{
    public $search = '';

    public function render()
    {
        $query = User::query()->where('status', 'active');

        if (Auth::check()) {
            $query->where('id', '!=', Auth::id());
        }

        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('username', 'like', '%' . $this->search . '%');
            })->take(5);
        } 
        else {
            $query->inRandomOrder()->limit(5);
        }

        return view('livewire.authors-to-follow', [
            'users' => $query->get()
        ]);
    }
}