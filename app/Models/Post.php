<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Gets the user, that is the author of this post.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Gets all the comments left on this post.
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Gets all the tags that are attatched to this post.
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // Gets all the likes that have been left on the post.
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}