<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'isAdmin' => true,
                'profile_photo' => 'default.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User1',
                'email' => 'user1@example.com',
                'password' => Hash::make('password'),
                'isAdmin' => false,
                'profile_photo' => 'default.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User2',
                'email' => 'user2@example.com',
                'password' => Hash::make('password'),
                'isAdmin' => false,
                'profile_photo' => 'default.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User3',
                'email' => 'user3@example.com',
                'password' => Hash::make('password'),
                'isAdmin' => false,
                'profile_photo' => 'default.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
