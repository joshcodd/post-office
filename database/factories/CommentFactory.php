<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the comment model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => Post::inRandomOrder()->first()->id,
            'user_id' => User::where('user_role', '!=', 'admin')->inRandomOrder()->first()->id,
            'content' => $this->faker->realText(200),
        ];
    }
}