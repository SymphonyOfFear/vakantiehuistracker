<x-app-layout>
    <x-header />

    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <x-sidebar title="Dashboard" class="bg-green-800 text-white w-64 p-4 shadow-lg">
            <ul class="space-y-2">
                <li><a href="{{ route('verhuurder.dashboard') }}"
                        class="flex items-center p-2 hover:bg-green-600 rounded-md transition-colors duration-300">
                        <span class="text-white">Dashboard</span></a>
                </li>
                <li><a href="{{ route('verhuurder.huizen.index') }}"
                        class="flex items-center p-2 hover:bg-green-600 rounded-md transition-colors duration-300">
                        <span class="text-white">Huizenbeheer</span></a>
                </li>
            </ul>
        </x-sidebar>

        <!-- Main Content -->
        <div class="flex-1 bg-white p-8 shadow-lg rounded-lg mx-4 my-6">
            <h1 class="text-3xl font-extrabold text-green-800 mb-4">Welkom bij uw favorieten vakantiehuizen</h1>
            <p class="text-gray-700 text-lg mb-8">Hier kunt u uw favorieten vakantiehuizen beheren</p>

            <!-- Additional Content Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="p-4 bg-green-100 border-l-4 border-green-500 shadow-md rounded-md">
                    <h2 class="text-xl font-semibold text-green-800">Huizenbeheer</h2>
                    <p class="text-gray-600">Beheer en bekijk uw favorieten vakantiehuizen, en voeg nieuwe woningen toe
                        aan uw portfolio.</p>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
