@extends('layouts.demo')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <h1 class="text-2xl font-bold mb-6 text-center">Kategorie Demo</h1>
    <div class="flex justify-end mb-4">
        <button onclick="showCategoryModal()" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600">Dodaj Kategorię</button>
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
                            Nazwa
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Akcje
                        </th>
                    </tr>
                </thead>
                <tbody id="categories-table" class="text-gray-600 text-sm font-light">
                    <!-- Categories will be inserted here by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for adding/editing category -->
<div id="category-modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-8 rounded shadow-lg w-full max-w-lg">
        <h2 class="text-xl font-bold mb-4" id="category-modal-title">Dodaj Kategorię</h2>
        <form id="category-form">
            <input type="hidden" id="category-id">
            <div class="mb-4">
                <label for="category-name" class="block text-gray-700">Nazwa</label>
                <input type="text" id="category-name" class="w-full border-gray-300 rounded" required>
                <p id="category-name-error" class="text-red-500 text-xs hidden">Proszę podać nazwę kategorii.</p>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="hideCategoryModal()" class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600 mr-2">Anuluj</button>
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
                localStorage.setItem('demo_categories', JSON.stringify(data.categories));
                loadCategories();
            });
    });

    function loadCategories() {
        const demoCategories = JSON.parse(localStorage.getItem('demo_categories')) || [];
        const table = document.getElementById('categories-table');
        table.innerHTML = '';
        demoCategories.forEach((category, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${index + 1}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${category.name}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <button onclick="editCategory(${index})" class="text-yellow-500 hover:text-yellow-600 mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M17.414 2.586a2 2 0 0 0-2.828 0l-11 11a2 2 0 0 0-.586 1.414V18a2 2 0 0 0 2 2h2.586a2 2 0 0 0 1.414-.586l11-11a2 2 0 0 0 0-2.828l-3-3zM8.586 16H6v-2.586L14.586 5.414 16.586 7.414 8.586 16z"/>
                        </svg>
                    </button>
                    <button onclick="deleteCategory(${index})" class="text-red-500 hover:text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v1h4a1 1 0 0 1 0 2h-1v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6H2a1 1 0 1 1 0-2h4V3zm2 3h6v10H7V6zm2 2v6h2V8H9z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </td>
            `;
            table.appendChild(row);
        });
    }

    function showCategoryModal() {
        document.getElementById('category-form').reset();
        document.getElementById('category-id').value = '';
        document.getElementById('category-modal-title').textContent = 'Dodaj Kategorię';
        document.getElementById('category-modal').classList.remove('hidden');
    }

    function hideCategoryModal() {
        document.getElementById('category-modal').classList.add('hidden');
    }

    function saveCategory(event) {
        event.preventDefault();
        const id = document.getElementById('category-id').value;
        const name = document.getElementById('category-name').value;

        // Validation
        let valid = true;
        if (!name) {
            document.getElementById('category-name-error').classList.remove('hidden');
            valid = false;
        } else {
            document.getElementById('category-name-error').classList.add('hidden');
        }

        if (!valid) {
            return;
        }

        const demoCategories = JSON.parse(localStorage.getItem('demo_categories')) || [];
        const category = { name };

        if (id) {
            demoCategories[id] = category;
        } else {
            demoCategories.push(category);
        }

        localStorage.setItem('demo_categories', JSON.stringify(demoCategories));
        loadCategories();
        hideCategoryModal();
    }

    function editCategory(index) {
        const demoCategories = JSON.parse(localStorage.getItem('demo_categories')) || [];
        const category = demoCategories[index];
        document.getElementById('category-id').value = index;
        document.getElementById('category-name').value = category.name;
        document.getElementById('category-modal-title').textContent = 'Edytuj Kategorię';
        document.getElementById('category-modal').classList.remove('hidden');
    }

    function deleteCategory(index) {
        const demoCategories = JSON.parse(localStorage.getItem('demo_categories')) || [];
        demoCategories.splice(index, 1);
        localStorage.setItem('demo_categories', JSON.stringify(demoCategories));
        loadCategories();
    }

    document.getElementById('category-form').addEventListener('submit', saveCategory);
</script>
@endsection
