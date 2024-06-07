@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="bg-white p-8 shadow-md rounded-lg w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6 text-center">Edytuj Transakcję</h1>

            <form action="{{ route('admin.transactions.update', $transaction->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="type" class="block text-gray-700 font-bold mb-2">Typ</label>
                    <select name="type" id="type" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="Dochody" {{ $transaction->type == 'Dochody' ? 'selected' : '' }}>Dochody</option>
                        <option value="Wydatki" {{ $transaction->type == 'Wydatki' ? 'selected' : '' }}>Wydatki</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M7 10l5 5 5-5H7z"/>
                        </svg>
                    </div>
                    @error('type')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="category_id" class="block text-gray-700 font-bold mb-2">Kategoria</label>
                    <select name="category_id" id="category_id" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $transaction->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M7 10l5 5 5-5H7z"/>
                        </svg>
                    </div>
                    @error('category_id')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="amount" class="block text-gray-700 font-bold mb-2">Kwota</label>
                    <input type="number" name="amount" id="amount" step="0.01" min="0.01" max="99999999.99" required pattern="\d+(\.\d{1,2})?" value="{{ $transaction->amount }}" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    @error('amount')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="date" class="block text-gray-700 font-bold mb-2">Data</label>
                    <input type="date" name="date" id="date" value="{{ $transaction->date }}" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    @error('date')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Opis</label>
                    <textarea name="description" id="description" rows="4" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">{{ $transaction->description }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-center">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Zapisz</button>
                </div>
            </form>
        </div>
    </div>

<script>
    document.getElementById('amount').addEventListener('input', function () {
    const value = this.value;
    const regex = /^\d+(\.\d{1,2})?$/;
    const parsedValue = parseFloat(value);
    if (!regex.test(value) || parsedValue > 99999999.99) {
        this.setCustomValidity('Wprowadź poprawną kwotę (maks. 99999999.99, maks. dwie liczby po przecinku).');
    } else {
        this.setCustomValidity('');
    }
});
</script>
@endsection
