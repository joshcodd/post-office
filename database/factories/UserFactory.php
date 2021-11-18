<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the user model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $first_name = $this->faker->firstName();
        $surname = $this->faker->lastName();
        $email = $first_name . "_" . $surname . rand(0, 99999) . "@example.com";
        return [
            'first_name' => $first_name,
            'surname' => $surname,
            'email' => $email,
            'email_verified_at' => $this->faker->dateTimeThisMonth(),
            'password' => $this->faker->password(),
            'remember_token' => Str::random(15),
        ];
    }

    /**
     * Indicate that the user model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}