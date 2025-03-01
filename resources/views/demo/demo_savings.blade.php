@extends('layouts.demo')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <h1 class="text-2xl font-bold mb-6 text-center">Oszczędności Demo</h1>
    <div class="flex justify-end mb-4">
        <button onclick="showSavingModal()" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600">Dodaj Oszczędność</button>
    </div>
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Cel
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Kwota
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Data
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Akcje
                        </th>
                    </tr>
                </thead>
                <tbody id="savings-table" class="text-gray-600 text-sm font-light">
                    <!-- Oszczednosci -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for adding/editing saving -->
<div id="saving-modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-8 rounded shadow-lg w-full max-w-lg">
        <h2 class="text-xl font-bold mb-4" id="saving-modal-title">Dodaj Oszczędność</h2>
        <form id="saving-form">
            <input type="hidden" id="saving-id">
            <div class="mb-4">
                <label for="saving-goal" class="block text-gray-700">Cel</label>
                <input type="text" id="saving-goal" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                <p id="saving-goal-error" class="text-red-500 text-xs hidden">Proszę podać cel oszczędności.</p>
            </div>
            <div class="mb-4">
                <label for="saving-amount" class="block text-gray-700">Kwota</label>
                <input type="number" id="saving-amount" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" step="0.01" min="0.01" required>
                <p id="saving-amount-error" class="text-red-500 text-xs hidden">Kwota musi być większa niż 0.01.</p>
            </div>
            <div class="mb-4">
                <label for="saving-date" class="block text-gray-700">Data</label>
                <input type="date" id="saving-date" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                <p id="saving-date-error" class="text-red-500 text-xs hidden">Proszę podać datę.</p>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="hideSavingModal()" class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600 mr-2">Anuluj</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600">Zapisz</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch("{{ route('demo.initialize') }}")
            .then(response => response.json())
            .then(data => {
                localStorage.setItem('demo_savings', JSON.stringify(data.savings));
                loadSavings();
            });
    });

    function loadSavings() {
        const demoSavings = JSON.parse(localStorage.getItem('demo_savings')) || [];
        const table = document.getElementById('savings-table');
        table.innerHTML = '';
        demoSavings.forEach((saving, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${index + 1}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${saving.goal}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${saving.amount}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${saving.date}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <button onclick="editSaving(${index})" class="text-yellow-500 hover:text-yellow-600 mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M17.414 2.586a2 2 0 0 0-2.828 0l-11 11a2 2 0 0 0-.586 1.414V18a2 2 0 0 0 2 2h2.586a2 2 0 0 0 1.414-.586l11-11a2 2 0 0 0 0-2.828l-3-3zM8.586 16H6v-2.586L14.586 5.414 16.586 7.414 8.586 16z"/>
                        </svg>
                    </button>
                    <button onclick="deleteSaving(${index})" class="text-red-500 hover:text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v1h4a1 1 0 0 1 0 2h-1v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6H2a1 1 0 1 1 0-2h4V3zm2 3h6v10H7V6zm2 2v6h2V8H9z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </td>
            `;
            table.appendChild(row);
        });
    }

    function showSavingModal() {
        document.getElementById('saving-form').reset();
        document.getElementById('saving-id').value = '';
        document.getElementById('saving-modal-title').textContent = 'Dodaj Oszczędność';
        document.getElementById('saving-modal').classList.remove('hidden');
    }

    function hideSavingModal() {
        document.getElementById('saving-modal').classList.add('hidden');
    }

    function saveSaving(event) {
        event.preventDefault();
        const id = document.getElementById('saving-id').value;
        const goal = document.getElementById('saving-goal').value;
        const amount = parseFloat(document.getElementById('saving-amount').value);
        const date = document.getElementById('saving-date').value;

        // Validation
        let valid = true;
        if (!goal) {
            document.getElementById('saving-goal-error').classList.remove('hidden');
            valid = false;
        } else {
            document.getElementById('saving-goal-error').classList.add('hidden');
        }
        if (isNaN(amount) || amount <= 0.01) {
            document.getElementById('saving-amount-error').classList.remove('hidden');
            valid = false;
        } else {
            document.getElementById('saving-amount-error').classList.add('hidden');
        }
        if (!date) {
            document.getElementById('saving-date-error').classList.remove('hidden');
            valid = false;
        } else {
            document.getElementById('saving-date-error').classList.add('hidden');
        }

        if (!valid) {
            return;
        }

        const demoSavings = JSON.parse(localStorage.getItem('demo_savings')) || [];
        const saving = { goal, amount, date };

        if (id) {
            demoSavings[id] = saving;
        } else {
            demoSavings.push(saving);
        }

        localStorage.setItem('demo_savings', JSON.stringify(demoSavings));
        loadSavings();
        hideSavingModal();
    }

    function editSaving(index) {
        const demoSavings = JSON.parse(localStorage.getItem('demo_savings')) || [];
        const saving = demoSavings[index];
        document.getElementById('saving-id').value = index;
        document.getElementById('saving-goal').value = saving.goal;
        document.getElementById('saving-amount').value = saving.amount;
        document.getElementById('saving-date').value = saving.date;
        document.getElementById('saving-modal-title').textContent = 'Edytuj Oszczędność';
        document.getElementById('saving-modal').classList.remove('hidden');
    }

    function deleteSaving(index) {
        const demoSavings = JSON.parse(localStorage.getItem('demo_savings')) || [];
        demoSavings.splice(index, 1);
        localStorage.setItem('demo_savings', JSON.stringify(demoSavings));
        loadSavings();
    }

    document.getElementById('saving-form').addEventListener('submit', saveSaving);
</script>
@endsection
