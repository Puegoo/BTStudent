@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <h1 class="text-3xl font-bold mb-5 text-center">Edytuj Oszczędność</h1>
    <form action="{{ route('savings.update', $saving->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="amount" class="block text-sm font-medium text-gray-700">Kwota</label>
            <input type="number" name="amount" id="amount" class="mt-1 p-2 block w-full border rounded-md" step="0.01" min="0.01" max="99999999.99" pattern="\d+(\.\d{1,2})?" value="{{ old('amount', $saving->amount) }}" required>
            @error('amount')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="goal" class="block text-sm font-medium text-gray-700">Cel</label>
            <input type="text" name="goal" id="goal" class="mt-1 p-2 block w-full border rounded-md" value="{{ old('goal', $saving->goal) }}" required>
            @error('goal')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="date" class="block text-sm font-medium text-gray-700">Data</label>
            <input type="date" name="date" id="date" class="mt-1 p-2 block w-full border rounded-md" value="{{ old('date', $saving->date) }}" required>
            @error('date')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600">Zaktualizuj</button>
        </div>
    </form>
</div>
@endsection
