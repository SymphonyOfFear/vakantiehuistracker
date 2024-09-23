<x-app-layout>
    <x-header />

    <div class="flex">
        <!-- Sidebar Component -->
        <div id="sidebar" class="bg-gray-100 w-64 h-screen shadow-lg p-4 transition-all duration-300">
            <!-- Sidebar Title -->
            <div class="flex justify-between items-center">
                <div class="text-lg font-semibold text-gray-800 mb-4">Menu</div>
                <!-- Close Sidebar Button -->
                <button id="toggleSidebarButton" onclick="toggleSidebar()" class="text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Sidebar Links -->
            <ul class="space-y-4">
                <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                        Huizen</a></li>
                <li><a href="{{ route('verhuurder.huizen.create') }}" class="text-gray-700 hover:text-green-600">Voeg
                        Huis Toe</a></li>
                <li><a href="{{ route('reserveringen.index') }}"
                        class="text-gray-700 hover:text-green-600">Reserveringen</a></li>
            </ul>
        </div>

        <div class="flex-1 p-6 bg-white">
            <h1 class="text-2xl font-bold">Beheer Uw Vakantiehuizen</h1>

            <!-- Add the filter component if needed -->
            <x-filter :locations="$locations" />

            <!-- Vacation Houses List -->
            @if ($huizen->isEmpty())
                <p class="text-gray-600">Geen vakantiehuizen beschikbaar.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                    @foreach ($huizen as $huis)
                        <div class="bg-white p-4 rounded-lg shadow">
                            <img src="{{ $huis->afbeelding ?? 'https://placehold.co/400' }}" alt="{{ $huis->naam }}"
                                class="w-full h-48 object-cover rounded-t-lg mb-4">
                            <h3 class="text-xl font-bold text-gray-800">{{ $huis->naam }}</h3>
                            <p class="text-gray-600">{{ $huis->locatie }}</p>
                            <p class="text-green-600 font-semibold">€ {{ $huis->prijs }}</p>
                            <a href="{{ route('huizen.show', $huis->id) }}"
                                class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                Bekijk details
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Show Sidebar Button (Initially Hidden) -->
        <button id="showSidebarButton" onclick="toggleSidebar()"
            class="fixed top-4 left-4 bg-green-600 text-white p-2 rounded-lg hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 6h18M3 18h18" />
            </svg>
        </button>
    </div>

    <x-footer />
</x-app-layout>
