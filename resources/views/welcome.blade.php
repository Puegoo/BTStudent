<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BTStudent - Witamy</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMyM/6irlf0uACAc5A49jUR0qf7pM/5f4c7JH2I" crossorigin="anonymous">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Styles -->
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>
    <div class="navbar bg-gray-100 flex justify-between items-center p-4">
        <div class="logo text-black text-2xl font-bold">BTStudent</div>
        <div class="md:hidden">
            <button id="menu-toggle" class="text-black focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
        <div id="menu" class="menu md:flex md:items-center">
            <a href="{{ route('demo') }}" class="nav-link"><i class="fas fa-play"></i> Demo</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home') }}" class="nav-link"><i class="fas fa-home"></i> Home</a>
                @else
                    <a href="{{ route('login') }}" class="nav-link nav-link-bold"><i class="fas fa-sign-in-alt"></i> Zaloguj się</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-link nav-link-bold"><i class="fas fa-user-plus"></i> Zarejestruj się</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>

    <div class="welcome flex flex-col justify-center items-center h-[80vh] text-center p-4">
        <img src="{{ asset('images/logo.png') }}" alt="BTStudent Logo" class="max-w-[150px] mb-4">
        <h1 class="text-4xl md:text-5xl mb-2">Witaj</h1>
        <p class="text-xl md:text-2xl">Piotr Nowak</p>
    </div>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            var menu = document.getElementById('menu');
            menu.classList.toggle('show');
        });
    </script>
</body>
</html>
