<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
        ]);

        User::create([
            'name' => 'User1',
            'email' => 'User1@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        User::create([
            'name' => 'user2',
            'email' => 'user2@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
