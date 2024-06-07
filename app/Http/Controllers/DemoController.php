<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function demoDashboard()
    {
        return view('demo.demo');
    }

    public function demoTransactions()
    {
        return view('demo.demo_transactions');
    }

    public function demoCategories()
    {
        return view('demo.demo_categories');
    }

    public function demoSavings()
    {
        return view('demo.demo_savings');
    }

    public function initializeDemoData()
    {
        $categories = [
            ['name' => 'Jedzenie'],
            ['name' => 'Transport'],
            ['name' => 'Rozrywka'],
        ];

        $savings = [
            ['goal' => 'Nowy laptop', 'amount' => 1500, 'date' => '2024-06-30'],
            ['goal' => 'Wakacje', 'amount' => 2000, 'date' => '2024-07-15'],
        ];

        $transactions = [
            ['type' => 'Dochody', 'category' => 'Jedzenie', 'amount' => 500, 'date' => '2024-06-01', 'description' => 'Wynagrodzenie'],
            ['type' => 'Wydatki', 'category' => 'Transport', 'amount' => 150, 'date' => '2024-06-03', 'description' => 'Bilet miesięczny'],
            ['type' => 'Dochody', 'category' => 'Rozrywka', 'amount' => 200, 'date' => '2024-06-05', 'description' => 'Zwrot podatku'],
            ['type' => 'Wydatki', 'category' => 'Jedzenie', 'amount' => 100, 'date' => '2024-06-07', 'description' => 'Zakupy spożywcze'],
        ];

        return response()->json([
            'categories' => $categories,
            'savings' => $savings,
            'transactions' => $transactions,
        ]);
    }
}
