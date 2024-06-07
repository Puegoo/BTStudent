@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <h1 class="text-3xl font-bold mb-5 text-center">Dodaj Kategorię</h1>
    <form action="{{ route('categories.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nazwa</label>
            <input type="text" name="name" id="name" class="mt-1 p-2 block w-full border rounded-md" value="{{ old('name') }}">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600">Dodaj</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('amount').addEventListener('input', function () {
        if (this.value > 99999999.99) {
            this.setCustomValidity('Kwota nie może przekraczać 999999999.99 PLN.');
        } else {
            this.setCustomValidity('');
        }
    });
</script>
@endsection
