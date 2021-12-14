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

        if (rand(0, 3) != 0) {
            $dir = storage_path() . "/app/public/images";
            $full_image_path = $this->faker->image($dir);
            $file_name = substr($full_image_path, strlen($dir));
        } else {
            $file_name = null;
        }

        return [
            'user_id' => User::where('user_role', '!=', 'admin')->inRandomOrder()->first()->id,
            'title' => $this->faker->realText(70),
            'image_path' => $file_name,
            'content' => $this->faker->realText(800),
        ];
    }
}