<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\Category; // Jangan lupa import ini
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostForm extends Component
{
    use WithFileUploads;

    public ?Post $post = null; // Tanda tanya berarti bisa null (mode create)
    
    // Form Inputs
    public $title;
    public $content;
    public $thumbnail;
    public $oldThumbnail;
    public $category_id; // Tambahan dari CreatePost
    public $tags;        // Tambahan dari CreatePost

    // Rules Validasi
    protected function rules()
    {
        return [
            'title'       => 'required|min:5|max:255',
            'content'     => 'required|min:10',
            'category_id' => 'required|exists:categories,id', // Wajib pilih kategori
            'tags'        => 'nullable|string',
            'thumbnail'   => $this->post ? 'nullable|image|max:5048' : 'required|image|max:5048',
        ];
    }

    public function mount(?Post $post = null)
    {
        // Jika ada post (Mode Edit), isi form dengan data lama
        if ($post && $post->exists) {
            $this->post = $post;
            
            $this->title        = $post->title;
            $this->content      = $post->content;
            $this->oldThumbnail = $post->thumbnail;
            $this->category_id  = $post->category_id;
            $this->tags         = $post->tags; 
        }
    }

    // Simpan Draft
    public function saveDraft()
    {
        $this->validate(['title' => 'required|min:3']);
        
        $this->savePost('draft');
        
        session()->flash('message', 'Draft berhasil disimpan!');
        return redirect()->route('profile.show', ['user' => Auth::user()->username]);
    }

    // Publish
    public function publish()
    {
        $this->validate(); 

        $this->savePost('published');
        
        session()->flash('message', 'Cerita berhasil dipublikasikan!');
        return redirect()->route('profile.show', ['user' => Auth::user()->username]);
    }

    private function savePost($status)
    {
        $thumbnailPath = $this->thumbnail 
            ? $this->thumbnail->store('post-images', 'public') 
            : $this->oldThumbnail;

        Post::updateOrCreate(
            ['id' => $this->post?->id],
            [
                'user_id'     => Auth::id(),
                'category_id' => $this->category_id,
                'title'       => $this->title,
                'slug'        => $this->post ? $this->post->slug : Str::slug($this->title) . '-' . Str::random(5),
                'content'     => $this->content,
                'thumbnail'   => $thumbnailPath,
                'tags'        => $this->tags,
                'status'      => $status,
                'view_count'  => $this->post ? $this->post->view_count : 0,
            ]
        );
    }

    public function render()
    {
        return view('livewire.post-form', [
            'categories' => Category::all() 
        ]);
    }
}