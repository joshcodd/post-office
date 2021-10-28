<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
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