<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Notifications\RecievedComment;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Seed the post table of the database.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post();
        $post->user_id = 1;
        $post->title = 'A first post on the blog!';
        $post->content = 'This is my first post here.';
        $post->save();

        $post_two = new Post();
        $post_two->user_id = 1;
        $post_two->title = 'How many times a week should you eat a salad?';
        $post_two->content = 'You should definitely eat salad 5 times a week!';
        $post_two->save();

        $post_three = new Post();
        $post_three->user_id = 2;
        $post_three->title = 'The UK cat population';
        $post_three->content = 'There are actually 12.2 million cats in the UK! WOW';
        $posts = $post_three::factory()->has(Comment::factory()->count(10))
            ->create(); // Seed 10 random comments for this post.
        $post_three->save();



        $posts->each(function ($post) {
            $comments = Post::find($post->id)->comments;
            $comments->each(function ($comment) {
                User::find($comment->user_id)->notify(new RecievedComment($comment));
            });
        });
        $posts = Post::factory()->count(35)->create();
    }
}