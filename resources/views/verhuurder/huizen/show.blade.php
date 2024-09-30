<!-- show.blade.php -->
<x-app-layout>
    <x-header />

    <div class="flex">
        <!-- Sidebar / Navigation -->
        <x-sidebar title="Huizenbeheer">
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                    Huizen</a></li>
            <li><a href="{{ route('verhuurder.huizen.create') }}" class="text-gray-700 hover:text-green-600">Voeg Huis
                    Toe</a></li>
        </x-sidebar>

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">{{ $vakantiehuis->naam }}</h1>

            <!-- Display Images of the Vacation Home -->
            @if ($vakantiehuis->images->isNotEmpty())
                <div class="mb-4">
                    <h2 class="text-xl font-semibold mb-2">Afbeeldingen</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($vakantiehuis->images as $image)
                            <div class="rounded-lg shadow">
                                <img src="{{ $image->url }}" alt="{{ $vakantiehuis->naam }}"
                                    class="w-full h-48 object-cover rounded-lg">
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <!-- Show placeholder if there are no images -->
                <div class="mb-4">
                    <img src="https://via.placeholder.com/400x300.png?text=Geen+Afbeeldingen+Beschikbaar"
                        alt="Geen afbeeldingen beschikbaar" class="w-full h-48 object-cover rounded-lg">
                </div>
            @endif

            <!-- Vacation Home Details -->
            <div class="mb-4">
                <h2 class="text-xl font-semibold">Details</h2>
                <p class="text-gray-800"><strong>Naam:</strong> {{ $vakantiehuis->naam }}</p>
                <p class="text-gray-800"><strong>Prijs:</strong> €{{ $vakantiehuis->prijs }}</p>
                <p class="text-gray-800"><strong>Beschrijving:</strong>
                    {{ $vakantiehuis->beschrijving ?? 'Geen beschrijving beschikbaar.' }}</p>
                <p class="text-gray-800"><strong>Locatie:</strong> {{ $vakantiehuis->straatnaam }}
                    {{ $vakantiehuis->huisnummer }}, {{ $vakantiehuis->postcode }} {{ $vakantiehuis->stad }}</p>
                <p class="text-gray-800"><strong>Aantal Slaapkamers:</strong> {{ $vakantiehuis->slaapkamers }}</p>
                <p class="text-gray-800"><strong>Beschikbaarheid:</strong>
                    {{ $vakantiehuis->beschikbaarheid ? 'Beschikbaar' : 'Niet beschikbaar' }}</p>
            </div>

            <!-- Features Section -->
            <div class="mb-4">
                <h2 class="text-xl font-semibold">Voorzieningen</h2>
                <ul class="list-disc pl-5 text-gray-800">
                    @if ($vakantiehuis->wifi)
                        <li>Wi-Fi</li>
                    @endif
                    @if ($vakantiehuis->zwembad)
                        <li>Zwembad</li>
                    @endif
                    @if ($vakantiehuis->parkeren)
                        <li>Parkeerplaats</li>
                    @endif
                    @if ($vakantiehuis->speeltuin)
                        <li>Speeltuin</li>
                    @endif
                    @if (!$vakantiehuis->wifi && !$vakantiehuis->zwembad && !$vakantiehuis->parkeren && !$vakantiehuis->speeltuin)
                        <li>Geen voorzieningen beschikbaar.</li>
                    @endif
                </ul>
            </div>

            <!-- Edit Button (Only visible if the user is the owner) -->
            @if (Auth::id() === $vakantiehuis->verhuurder_id)
                <div class="mb-4">
                    <a href="{{ route('verhuurder.huizen.edit', $vakantiehuis->id) }}"
                        class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Bewerk
                        Vakantiehuis</a>
                </div>
            @endif

            <!-- Back Button -->
            <div>
                <a href="{{ route('verhuurder.huizen.index') }}"
                    class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    Terug naar overzicht
                </a>
            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
