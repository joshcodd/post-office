<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use App\Notifications\RecievedComment;
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
        $comment->post_id = 3;
        $comment->content = 'This is my first comment.';
        $comment->save();

        $comment_two = new Comment();
        $comment_two->user_id = 2;
        $comment_two->post_id = 1;
        $comment_two->content = 'Welcome!';
        $comment_two->save();

        $comment_three = new Comment();
        $comment_three->user_id = 3;
        $comment_three->post_id = 2;
        $comment_three->content = 'I eat salad 7 times a week lol!';
        $comment_three->save();

        $comments = Comment::factory()->count(100)->create();

        User::find($comment->user_id)->notify(new RecievedComment($comment));
        User::find($comment_two->user_id)->notify(new RecievedComment($comment_two));
        User::find($comment_three->user_id)->notify(new RecievedComment($comment_three));
        $comments->each(function ($current_comment) {
            User::find($current_comment->user_id)->notify(new RecievedComment($current_comment));
        });
    }
}