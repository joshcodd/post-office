<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Seed the comment table of the database.
     *
     * @return void
     */
    public function run()
    {
        $comment = new Comment();
        $comment->user_id = 1;
        $comment->post_id = 1;
        $comment->content = 'This is my first comment.';
        $comment->save();

        $comments = Comment::factory()->count(10)->create();
    }
}