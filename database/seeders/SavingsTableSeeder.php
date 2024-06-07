<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SavingsTableSeeder extends Seeder
{
    public function run()
    {
        $adminId = DB::table('users')->where('email', 'admin@example.com')->first()->id;
        $userOneId = DB::table('users')->where('email', 'user1@example.com')->first()->id;
        $userTwoId = DB::table('users')->where('email', 'user2@example.com')->first()->id;
        $userThreeId = DB::table('users')->where('email', 'user3@example.com')->first()->id;

        DB::table('savings')->insert([
            [
                'user_id' => $adminId,
                'amount' => 200.00,
                'goal' => 'Nowy laptop',
                'date' => '2023-12-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userOneId,
                'amount' => 150.00,
                'goal' => 'Wakacje',
                'date' => '2023-11-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userTwoId,
                'amount' => 100.00,
                'goal' => 'Samochód',
                'date' => '2023-10-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userThreeId,
                'amount' => 50.00,
                'goal' => 'Kurs online',
                'date' => '2023-09-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
