<nav class="bg-white shadow p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-xl font-bold text-gray-900">BTStudent</div>
        <div class="hidden md:flex space-x-4">
            <a href="{{ route('dashboard') }}" class="nav-item {{ Request::routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('transactions.index') }}" class="nav-item {{ Request::routeIs('transactions.index') ? 'active' : '' }}">Transakcje</a>
            <a href="{{ route('categories.index') }}" class="nav-item {{ Request::routeIs('categories.index') ? 'active' : '' }}">Kategorie</a>
            <a href="{{ route('savings.index') }}" class="nav-item {{ Request::routeIs('savings.index') ? 'active' : '' }}">Oszczędności</a>
            <a href="{{ route('profile') }}" class="nav-item {{ Request::routeIs('profile') ? 'active' : '' }}">Profil</a>
            @if(auth()->check() && auth()->user()->isAdmin)
                <a href="{{ route('admin.users.index') }}" class="nav-item {{ Request::routeIs('admin.users.index') ? 'active' : '' }}">Użytkownicy</a>
            @endif
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="nav-item logout-button">Wyloguj</button>
            </form>
        </div>
        <div class="md:hidden">
            <button id="menu-toggle" class="text-gray-900 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </div>
    <div id="menu" class="md:hidden hidden">
        <a href="{{ route('dashboard') }}" class="nav-item block {{ Request::routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('transactions.index') }}" class="nav-item block {{ Request::routeIs('transactions.index') ? 'active' : '' }}">Transakcje</a>
        <a href="{{ route('categories.index') }}" class="nav-item block {{ Request::routeIs('categories.index') ? 'active' : '' }}">Kategorie</a>
        <a href="{{ route('savings.index') }}" class="nav-item block {{ Request::routeIs('savings.index') ? 'active' : '' }}">Oszczędności</a>
        <a href="{{ route('profile') }}" class="nav-item block {{ Request::routeIs('profile') ? 'active' : '' }}">Profil</a>
        @if(auth()->check() && auth()->user()->isAdmin)
            <a href="{{ route('admin.users.index') }}" class="nav-item block {{ Request::routeIs('admin.users.index') ? 'active' : '' }}">Użytkownicy</a>
        @endif
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="block">
            @csrf
            <button type="submit" class="nav-item block logout-button">Wyloguj</button>
        </form>
    </div>
</nav>

<style>
    .nav-item {
        margin-right: 1rem;
        padding: 0.5rem 1rem;
        text-decoration: none;
        color: #000;
        background-color: #fff;
        border-radius: 5px;
    }
    .nav-item:hover {
        background-color: #f3f4f6;
    }
    .active {
        border-bottom: 2px solid #6366f1;
    }
    .logout-button {
        font-weight: bold;
        color: #ef4444;
    }
    .logout-button:hover {
        background-color: #ef4444;
        color: white;
    }
</style>

<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        var menu = document.getElementById('menu');
        menu.classList.toggle('hidden');
    });

    // Ensure menu is hidden on page load
    document.addEventListener('DOMContentLoaded', function() {
        var menu = document.getElementById('menu');
        menu.classList.add('hidden');
    });
</script>
