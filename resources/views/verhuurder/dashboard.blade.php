{{-- Verhuurder Dashboard --}}
<x-app-layout>
    <div class="flex h-screen">
        <!-- Sidebar -->
        <x-sidebar title="Dashboard">
            <li><a href="{{ route('verhuurder.dashboard') }}" class="text-gray-700 hover:text-green-600">Dashboard</a>
            </li>
            <li><a href="{{ route('verhuurder.huizen.index') }}"
                    class="text-gray-700 hover:text-green-600">Huizenbeheer</a></li>
        </x-sidebar>

        <!-- Main Content -->
        <div class="w-full bg-white p-6">
            <h1 class="text-2xl font-bold">Welkom bij het Verhuurder Dashboard</h1>
            <p>Hier kunt u uw vakantiehuizen beheren en reserveringen bekijken.</p>
        </div>
    </div>


</x-app-layout>
