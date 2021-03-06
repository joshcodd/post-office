<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Seed the user table of the database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->has(Post::factory()->count(20))
            ->create();
        $user->first_name = 'Josh';
        $user->surname = "Codd";
        $user->email = 'jjc21@live.co.uk';
        $user->password = Hash::make('password');
        $user->remember_token = "AHEY4NSH47DHS7G";
        $user->save();

        $user_two = new User();
        $user_two->first_name = 'Avril';
        $user_two->surname = "Lavigne";
        $user_two->email = 'avril@lavigne.com';
        $user_two->password = '1234';
        $user_two->remember_token = "HEUDNDGFHHHHH33";
        $user_two->save();

        $user_three = new User();
        $user_three->first_name = 'Jeff';
        $user_three->surname = "Davies";
        $user_three->email = 'fejj@google.com';
        $user_three->password = 'jeffiscool';
        $user_three->remember_token = "8375HDNJFHYRH3H";
        $user_three::factory()->has(Post::factory()->count(5))
            ->create(); // Seed 5 random posts for this user.
        $user_three->save();

        $admin = new User();
        $admin->first_name = 'James';
        $admin->surname = "Manageer";
        $admin->email = 'admin@postoffice.com';
        $admin->password = Hash::make('password');
        $admin->user_role = 'admin';
        $admin->remember_token = "JBFJHWEBCFJH3";
        $admin->save();

        $users = User::factory()->count(20)->create();
    }
}