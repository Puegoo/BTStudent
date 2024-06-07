@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10 px-4">
        <h1 class="text-3xl font-bold mb-5 text-center">Transakcje</h1>
        <div class="flex justify-between mb-5">
            <a href="{{ route('transactions.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600">Dodaj Transakcję</a>
        </div>
        <div class="bg-white shadow-md rounded my-6">
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Data</th>
                            <th class="py-3 px-6 text-left">Kategoria</th>
                            <th class="py-3 px-6 text-left">Typ</th>
                            <th class="py-3 px-6 text-left">Kwota</th>
                            <th class="py-3 px-6 text-center">Akcje</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach($transactions as $transaction)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <span class="font-medium">{{ $transaction->date->format('Y-m-d') }}</span>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <span>{{ $transaction->category->name }}</span>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <span class="px-2 py-1 font-semibold leading-tight text-{{ $transaction->type == 'Dochody' ? 'green-700 bg-green-100' : 'red-700 bg-red-100' }} rounded-full">
                                        {{ $transaction->type }}
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <span>{{ number_format($transaction->amount, 2) }} PLN</span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <a href="{{ route('transactions.edit', $transaction->id) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M17.414 2.586a2 2 0 0 0-2.828 0l-11 11a2 2 0 0 0-.586 1.414V18a2 2 0 0 0 2 2h2.586a2 2 0 0 0 1.414-.586l11-11a2 2 0 0 0 0-2.828l-3-3zM8.586 16H6v-2.586L14.586 5.414 16.586 7.414 8.586 16z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tę transakcję?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5 3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v1h4a1 1 0 0 1 0 2h-1v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6H2a1 1 0 1 1 0-2h4V3zm2 3h6v10H7V6zm2 2v6h2V8H9z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
