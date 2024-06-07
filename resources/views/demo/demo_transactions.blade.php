@extends('layouts.demo')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <h1 class="text-2xl font-bold mb-6 text-center">Transakcje Demo</h1>
    <div class="flex justify-end mb-4">
        <button onclick="showTransactionModal()" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600">Dodaj Transakcję</button>
    </div>
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
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Akcje</th>
                    </tr>
                </thead>
                <tbody id="transactions-table" class="text-gray-600 text-sm font-light">
                    <!-- Transactions will be inserted here by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for adding/editing transaction -->
<div id="transaction-modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-8 rounded shadow-lg w-full max-w-lg">
        <h2 class="text-xl font-bold mb-4" id="modal-title">Dodaj Transakcję</h2>
        <form id="transaction-form">
            <input type="hidden" id="transaction-id">
            <div class="mb-4">
                <label for="type" class="block text-gray-700">Typ</label>
                <select id="type" class="w-full border-gray-300 rounded" required>
                    <option value="">Wybierz typ</option>
                    <option value="Dochody">Dochody</option>
                    <option value="Wydatki">Wydatki</option>
                </select>
                <p id="type-error" class="text-red-500 text-xs hidden">Proszę wybrać typ.</p>
            </div>
            <div class="mb-4">
                <label for="category" class="block text-gray-700">Kategoria</label>
                <input type="text" id="category" class="w-full border-gray-300 rounded" required>
                <p id="category-error" class="text-red-500 text-xs hidden">Proszę podać kategorię.</p>
            </div>
            <div class="mb-4">
                <label for="amount" class="block text-gray-700">Kwota</label>
                <input type="number" id="amount" class="w-full border-gray-300 rounded" step="0.01" min="0.01" required>
                <p id="amount-error" class="text-red-500 text-xs hidden">Kwota musi być większa niż 0.01.</p>
            </div>
            <div class="mb-4">
                <label for="date" class="block text-gray-700">Data</label>
                <input type="date" id="date" class="w-full border-gray-300 rounded" required>
                <p id="date-error" class="text-red-500 text-xs hidden">Proszę podać datę.</p>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Opis</label>
                <textarea id="description" class="w-full border-gray-300 rounded" required></textarea>
                <p id="description-error" class="text-red-500 text-xs hidden">Proszę podać opis.</p>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="hideTransactionModal()" class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600 mr-2">Anuluj</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600">Zapisz</button>
            </div>
        </form>
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
                    loadTransactions();
                });
        } else {
            loadTransactions();
        }
    });

    function loadTransactions() {
        const transactions = JSON.parse(localStorage.getItem('demo_transactions')) || [];
        const table = document.getElementById('transactions-table');
        table.innerHTML = '';
        transactions.forEach((transaction, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${index + 1}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${transaction.type}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${transaction.category}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${transaction.amount}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${transaction.date}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${transaction.description}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <button onclick="editTransaction(${index})" class="text-yellow-500 hover:text-yellow-600 mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M17.414 2.586a2 2 0 0 0-2.828 0l-11 11a2 2 0 0 0-.586 1.414V18a2 2 0 0 0 2 2h2.586a2 2 0 0 0 1.414-.586l11-11a2 2 0 0 0 0-2.828l-3-3zM8.586 16H6v-2.586L14.586 5.414 16.586 7.414 8.586 16z"/>
                        </svg>
                    </button>
                    <button onclick="deleteTransaction(${index})" class="text-red-500 hover:text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v1h4a1 1 0 0 1 0 2h-1v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6H2a1 1 0 1 1 0-2h4V3zm2 3h6v10H7V6zm2 2v6h2V8H9z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </td>
            `;
            table.appendChild(row);
        });
    }

    function showTransactionModal() {
        document.getElementById('transaction-form').reset();
        document.getElementById('transaction-id').value = '';
        document.getElementById('modal-title').textContent = 'Dodaj Transakcję';
        document.getElementById('transaction-modal').classList.remove('hidden');
    }

    function hideTransactionModal() {
        document.getElementById('transaction-modal').classList.add('hidden');
    }

    function saveTransaction(event) {
        event.preventDefault();
        const transactions = JSON.parse(localStorage.getItem('demo_transactions')) || [];
        const id = document.getElementById('transaction-id').value;
        const type = document.getElementById('type').value;
        const category = document.getElementById('category').value;
        const amount = parseFloat(document.getElementById('amount').value);
        const date = document.getElementById('date').value;
        const description = document.getElementById('description').value;

        // Validation
        let valid = true;
        if (!type) {
            document.getElementById('type-error').classList.remove('hidden');
            valid = false;
        } else {
            document.getElementById('type-error').classList.add('hidden');
        }
        if (!category) {
            document.getElementById('category-error').classList.remove('hidden');
            valid = false;
        } else {
            document.getElementById('category-error').classList.add('hidden');
        }
        if (isNaN(amount) || amount <= 0.01) {
            document.getElementById('amount-error').classList.remove('hidden');
            valid = false;
        } else {
            document.getElementById('amount-error').classList.add('hidden');
        }
        if (!date) {
            document.getElementById('date-error').classList.remove('hidden');
            valid = false;
        } else {
            document.getElementById('date-error').classList.add('hidden');
        }
        if (!description) {
            document.getElementById('description-error').classList.remove('hidden');
            valid = false;
        } else {
            document.getElementById('description-error').classList.add('hidden');
        }

        if (!valid) {
            return;
        }

        const transaction = { type, category, amount, date, description };

        if (id) {
            transactions[id] = transaction;
        } else {
            transactions.push(transaction);
        }

        localStorage.setItem('demo_transactions', JSON.stringify(transactions));
        loadTransactions();
        hideTransactionModal();
    }

    function editTransaction(index) {
        const transactions = JSON.parse(localStorage.getItem('demo_transactions')) || [];
        const transaction = transactions[index];
        document.getElementById('transaction-id').value = index;
        document.getElementById('type').value = transaction.type;
        document.getElementById('category').value = transaction.category;
        document.getElementById('amount').value = transaction.amount;
        document.getElementById('date').value = transaction.date;
        document.getElementById('description').value = transaction.description;
        document.getElementById('modal-title').textContent = 'Edytuj Transakcję';
        document.getElementById('transaction-modal').classList.remove('hidden');
    }

    function deleteTransaction(index) {
        const transactions = JSON.parse(localStorage.getItem('demo_transactions')) || [];
        transactions.splice(index, 1);
        localStorage.setItem('demo_transactions', JSON.stringify(transactions));
        loadTransactions();
    }

    document.getElementById('transaction-form').addEventListener('submit', saveTransaction);
</script>
@endsection
