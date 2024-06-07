@extends('layouts.demo')

@section('content')
    <div class="container mx-auto mt-8 px-4">
        <h1 class="text-2xl font-bold mb-6 text-center">Panel Demo</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
            <div class="bg-green-500 text-white p-4 rounded shadow">
                <h2 class="text-xl">Całkowity Dochód</h2>
                <p id="total-income" class="text-3xl">0.00 PLN</p>
            </div>
            <div class="bg-red-500 text-white p-4 rounded shadow">
                <h2 class="text-xl">Całkowite Wydatki</h2>
                <p id="total-expenses" class="text-3xl">0.00 PLN</p>
            </div>
            <div class="bg-blue-500 text-white p-4 rounded shadow">
                <h2 class="text-xl">Łączne Saldo</h2>
                <p id="total-balance" class="text-3xl">0.00 PLN</p>
            </div>
        </div>
        <h2 class="text-xl font-bold mb-4">Ostatnie Transakcje</h2>
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Typ</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategoria</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kwota</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Data</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Opis</th>
                        </tr>
                    </thead>
                    <tbody id="recent-transactions-table" class="text-gray-600 text-sm font-light">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const demoTransactions = localStorage.getItem('demo_transactions');
        if (!demoTransactions) {
            fetch("{{ route('demo.initialize') }}")
                .then(response => response.json())
                .then(data => {
                    localStorage.setItem('demo_transactions', JSON.stringify(data.transactions));
                    localStorage.setItem('demo_savings', JSON.stringify(data.savings));
                    loadRecentTransactions();
                    calculateTotals();
                });
        } else {
            loadRecentTransactions();
            calculateTotals();
        }
    });

    function loadRecentTransactions() {
        const demoTransactions = JSON.parse(localStorage.getItem('demo_transactions')) || [];
        const table = document.getElementById('recent-transactions-table');
        table.innerHTML = '';
        demoTransactions.slice(0, 5).forEach((transaction, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${index + 1}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${transaction.type}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${transaction.category}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${transaction.amount}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${transaction.date}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${transaction.description}</td>
            `;
            table.appendChild(row);
        });
    }

    function calculateTotals() {
        const demoTransactions = JSON.parse(localStorage.getItem('demo_transactions')) || [];
        let totalIncome = 0;
        let totalExpenses = 0;

        demoTransactions.forEach(transaction => {
            if (transaction.type === 'Dochody') {
                totalIncome += parseFloat(transaction.amount);
            } else if (transaction.type === 'Wydatki') {
                totalExpenses += parseFloat(transaction.amount);
            }
        });

        const totalBalance = totalIncome - totalExpenses;

        document.getElementById('total-income').textContent = `${totalIncome.toFixed(2)} PLN`;
        document.getElementById('total-expenses').textContent = `${totalExpenses.toFixed(2)} PLN`;
        document.getElementById('total-balance').textContent = `${totalBalance.toFixed(2)} PLN`;
    }
</script>
@endsection
