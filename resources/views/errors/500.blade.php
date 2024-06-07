@extends('layouts.app')

@section('title', 'Błąd serwera')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-4xl font-bold mb-4">500 - Błąd serwera</h1>
        <p class="text-lg mb-4">Przepraszamy, ale wystąpił wewnętrzny błąd serwera.</p>
        <a href="{{ url('/') }}" class="text-blue-500 hover:underline">Powrót do strony głównej</a>
    </div>
</div>
@endsection
