<!-- resources/views/verhuurder/dashboard.blade.php -->
<x-app-layout>
    <x-header />

    <div class="flex">
        <!-- Sidebar Component for the Dashboard -->
        <x-sidebar title="Dashboard Menu">
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                    Huizen</a></li>
            <li><a href="{{ route('verhuurder.dashboard') }}" class="text-gray-700 hover:text-green-600">Reserveringen</a>
            </li>
        </x-sidebar>

        <div class="w-full lg:w-3/4 p-6 bg-white">
            <h1 class="text-2xl font-bold">Welkom bij het Verhuurder Dashboard</h1>
            <p>Hier kunt u uw vakantiehuizen beheren en reserveringen bekijken.</p>
        </div>
    </div>

    <x-footer />
</x-app-layout>
