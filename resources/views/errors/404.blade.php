@extends('layouts.app')

@section('title', 'Strona nie znaleziona')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-4xl font-bold mb-4">404 - Strona nie znaleziona</h1>
        <p class="text-lg mb-4">Przepraszamy, ale strona, której szukasz, nie została znaleziona.</p>
        <a href="{{ url('/') }}" class="text-blue-500 hover:underline">Powrót do strony głównej</a>
    </div>
</div>
@endsection
