<?php

namespace App\Models;

use App\Comment;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id', 'uid')->count();
    }

    public function likers()
    {
        return $this->hasManyThrough(User::class, Like::class);
    }
}
