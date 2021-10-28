<?php

namespace Database\Seeders;

use App\Models\Post;
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
        $post->title = 'A first post';
        $post->content = 'This is my first post here.';
        $post->save();
        
        $posts = Post::factory()->count(10)->create();
    }
}