<nav class="bg-white shadow p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-xl font-bold text-gray-900">BTStudent</div>
        <div class="hidden md:flex space-x-4">
            <a href="{{ route('demo') }}" class="nav-item {{ Request::routeIs('demo') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('demo.demo_transactions') }}" class="nav-item {{ Request::routeIs('demo.demo_transactions') ? 'active' : '' }}">Transakcje</a>
            <a href="{{ route('demo.demo_categories') }}" class="nav-item {{ Request::routeIs('demo.demo_categories') ? 'active' : '' }}">Kategorie</a>
            <a href="{{ route('demo.demo_savings') }}" class="nav-item {{ Request::routeIs('demo.demo_savings') ? 'active' : '' }}">Oszczędności</a>
            <a href="#" class="nav-item disabled" title="Zablokowane w trybie demo">Profil</a>
            <a href="{{ route('welcome') }}" class="nav-item logout-button">Wyjdź</a>
        </div>
        <div class="md:hidden">
            <button id="menu-toggle" class="text-gray-900 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </div>
    <div id="menu" class="md:hidden mt-2 hidden">
        <a href="{{ route('demo') }}" class="nav-item block {{ Request::routeIs('demo') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('demo.demo_transactions') }}" class="nav-item block {{ Request::routeIs('demo.demo_transactions') ? 'active' : '' }}">Transakcje</a>
        <a href="{{ route('demo.demo_categories') }}" class="nav-item block {{ Request::routeIs('demo.demo_categories') ? 'active' : '' }}">Kategorie</a>
        <a href="{{ route('demo.demo_savings') }}" class="nav-item block {{ Request::routeIs('demo.demo_savings') ? 'active' : '' }}">Oszczędności</a>
        <a href="#" class="nav-item block disabled" title="Zablokowane w trybie demo">Profil</a>
        <a href="{{ route('welcome') }}" class="nav-item block logout-button">Wyjdź</a>
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
        transition: background-color 0.3s;
    }

    .nav-item:hover {
        background-color: #f3f4f6;
    }

    .active {
        border-bottom: 2px solid #6366f1;
    }

    .disabled {
        color: #a0aec0;
        cursor: not-allowed;
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
</script>
