<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Gets the post that the comment is about.
    public function post() 
    {
        return $this->belongsTo(Post::class);   
    }

    // Gets the user, that is the author of the comment.
    public function user()
    {
        return $this->belongsTo(User::class);   
    }
}