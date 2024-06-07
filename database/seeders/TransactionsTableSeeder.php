<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionsTableSeeder extends Seeder
{
    public function run()
    {
        $adminId = DB::table('users')->where('email', 'admin@example.com')->first()->id;
        $userOneId = DB::table('users')->where('email', 'user1@example.com')->first()->id;
        $userTwoId = DB::table('users')->where('email', 'user2@example.com')->first()->id;
        $userThreeId = DB::table('users')->where('email', 'user3@example.com')->first()->id;

        DB::table('transactions')->insert([
            [
                'user_id' => $adminId,
                'category_id' => 1,
                'amount' => 50.00,
                'type' => 'Wydatki',
                'date' => '2023-05-01',
                'description' => 'Zakupy spożywcze',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $adminId,
                'category_id' => 2,
                'amount' => 15.00,
                'type' => 'Wydatki',
                'date' => '2023-05-02',
                'description' => 'Bilet autobusowy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $adminId,
                'category_id' => 3,
                'amount' => 100.00,
                'type' => 'Dochody',
                'date' => '2023-05-03',
                'description' => 'Sprzedaż starego podręcznika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userOneId,
                'category_id' => 4,
                'amount' => 60.00,
                'type' => 'Wydatki',
                'date' => '2023-06-01',
                'description' => 'Kolacja',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userTwoId,
                'category_id' => 7,
                'amount' => 70.00,
                'type' => 'Wydatki',
                'date' => '2023-07-01',
                'description' => 'Zakupy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userThreeId,
                'category_id' => 10,
                'amount' => 80.00,
                'type' => 'Dochody',
                'date' => '2023-08-01',
                'description' => 'Sprzedaż gadżetów',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
