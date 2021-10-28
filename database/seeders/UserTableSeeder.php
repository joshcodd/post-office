<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Seed the user table of the database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Josh';
        $user->email = 'jjc21@live.co.uk';
        $user->password = 'password123';
        $user->save();

        $users = User::factory()->count(10)->create();
    }
}