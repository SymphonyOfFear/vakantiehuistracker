<x-app-layout>
    <x-header />

    <div class="flex">
        <x-sidebar title="Huizenbeheer">
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                    Huizen</a></li>
            <li><a href="{{ route('verhuurder.huizen.create') }}" class="text-gray-700 hover:text-green-600">Voeg Huis
                    Toe</a></li>
        </x-sidebar>

        <div class="w-full lg:w-3/4 p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">{{ $vakantiehuis->naam }}</h1>

            <p><strong>Prijs: </strong>€{{ $vakantiehuis->prijs }}</p>
            <p><strong>Beschrijving: </strong>{{ $vakantiehuis->beschrijving }}</p>

            <div id="map" style="height: 400px;"></div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
