<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'content',
        'status',
        'thumbnail',
        'view_count',
    ];
    
    public function user() { 
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function favorites() {
        return $this->hasMany(Favorite::class);
    }

    public function reshares() {
        return $this->hasMany(Reshare::class);
    }

    public function postImages() {
        return $this->hasMany(PostImage::class);
    }
}
