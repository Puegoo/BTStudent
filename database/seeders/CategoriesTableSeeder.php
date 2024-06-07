<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $adminId = DB::table('users')->where('email', 'admin@example.com')->value('id');
        $userOneId = DB::table('users')->where('email', 'user1@example.com')->value('id');
        $userTwoId = DB::table('users')->where('email', 'user2@example.com')->value('id');
        $userThreeId = DB::table('users')->where('email', 'user3@example.com')->value('id');

        DB::table('categories')->insert([
            ['name' => 'Jedzenie', 'user_id' => $adminId, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Transport', 'user_id' => $adminId, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rozrywka', 'user_id' => $adminId, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jedzenie', 'user_id' => $userOneId, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Transport', 'user_id' => $userOneId, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rozrywka', 'user_id' => $userOneId, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jedzenie', 'user_id' => $userTwoId, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Transport', 'user_id' => $userTwoId, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rozrywka', 'user_id' => $userTwoId, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jedzenie', 'user_id' => $userThreeId, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Transport', 'user_id' => $userThreeId, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rozrywka', 'user_id' => $userThreeId, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
