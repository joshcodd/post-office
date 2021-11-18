<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the post model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::where('user_role', '!=', 'admin')->inRandomOrder()->first()->id,
            'title' => $this->faker->realText(70),
            'content' => $this->faker->realText(800),
        ];
    }
}