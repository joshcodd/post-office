<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the tag database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = new Tag();
        $tag->name = "music";
        $tag->save();

        $tag_two = new Tag();
        $tag_two->name = "programming";
        $tag_two->save();

        $tag_three = new Tag();
        $tag_three->name = "memes";
        $tag_three->save();

        $tags = Tag::factory()->count(15)->create();
    }
}