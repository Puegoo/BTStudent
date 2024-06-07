@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Profil</h1>
    <div class="flex justify-center">
        <div class="bg-white shadow-md rounded-lg overflow-hidden w-full max-w-2xl">
            <div class="flex justify-center p-6">
                <div class="w-32 h-32">
                    <img class="rounded-full w-full h-full object-cover" src="{{ $user->profile_photo ? asset('storage/images/' . $user->profile_photo) : asset('images/unknown.png') }}" alt="Profile Photo">
                </div>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nazwa:</label>
                    <p class="text-lg">{{ $user->name }}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <p class="text-lg">{{ $user->email }}</p>
                </div>
                <div class="flex justify-end">
                    <a href="{{ route('profile.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600">Edytuj Profil</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Sekcja dla wykresu -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold mb-4 text-center">Wydatki i Dochody w skali miesiąca</h2>
        <canvas id="incomeExpenseChart"></canvas>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('incomeExpenseChart').getContext('2d');

        fetch("{{ route('profile.chartData') }}")
            .then(response => response.json())
            .then(data => {
                const chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [
                            {
                                label: 'Dochody',
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1,
                                data: data.income
                            },
                            {
                                label: 'Wydatki',
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1,
                                data: data.expenses
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    });
</script>
@endsection
