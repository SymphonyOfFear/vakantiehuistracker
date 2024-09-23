<x-app-layout>
    <x-header />

    <div class="flex">
        <!-- Sidebar Component for Verhuurder Huizen -->
        <x-sidebar title="Huizenbeheer">
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                    Huizen</a></li>
            <li><a href="{{ route('verhuurder.huizen.create') }}" class="text-gray-700 hover:text-green-600">Voeg Huis
                    Toe</a></li>
        </x-sidebar>

        <div class="w-full lg:w-3/4 p-6 bg-white">
            <h1 class="text-2xl font-bold">Beheer Uw Vakantiehuizen</h1>
            <!-- Add the filter component if needed -->
            <x-filter :locations="$locations" />
        </div>
    </div>

    <x-footer />
</x-app-layout>
