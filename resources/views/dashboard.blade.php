@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <h1 class="text-2xl font-bold mb-6 text-center">Panel Administracyjny</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        <div class="bg-green-500 text-white p-4 rounded shadow">
            <h2 class="text-xl">Całkowity Dochód</h2>
            <p class="text-3xl">{{ number_format($totalIncome, 2) }} PLN</p>
        </div>
        <div class="bg-red-500 text-white p-4 rounded shadow">
            <h2 class="text-xl">Całkowite Wydatki</h2>
            <p class="text-3xl">{{ number_format($totalExpenses, 2) }} PLN</p>
        </div>
        <div class="bg-blue-500 text-white p-4 rounded shadow">
            <h2 class="text-xl">Łączne Saldo</h2>
            <p class="text-3xl">{{ number_format($balance, 2) }} PLN</p>
        </div>
    </div>
    <h2 class="text-xl font-bold mb-4">Ostatnie Transakcje</h2>
    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Typ
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Kategoria
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Kwota
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Data
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Opis
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentTransactions as $transaction)
                    <tr>
                        <td class="px-2 py-1 font-semibold leading-tight text-{{ $transaction->type == 'Dochody' ? 'green-700 bg-green-100' : 'red-700 bg-red-100' }} rounded-none">{{ $transaction->type }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $transaction->category->name }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ number_format($transaction->amount, 2) }} PLN</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $transaction->date->format('Y-m-d') }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $transaction->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
