<!-- huizen/show.blade.php -->
<x-app-layout>
    <x-header />

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <!-- Vakantiehuis Titel -->
        <h1 class="text-4xl font-bold text-gray-800 mb-6 border-b-2 border-green-500 pb-4">{{ $vakantiehuis->naam }}</h1>

        <!-- Afbeeldingen van het Vakantiehuis -->
        @if ($vakantiehuis->images->isNotEmpty())
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-gray-700">Afbeeldingen</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($vakantiehuis->images as $image)
                        <div
                            class="overflow-hidden rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                            <img src="{{ $image->url }}" alt="{{ $vakantiehuis->naam }}"
                                class="w-full h-48 object-cover">
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <!-- Placeholder Afbeelding -->
            <div class="mb-8 text-center">
                <img src="https://via.placeholder.com/600x400.png?text=Geen+Afbeeldingen+Beschikbaar"
                    alt="Geen afbeeldingen beschikbaar"
                    class="w-full md:w-3/4 lg:w-1/2 mx-auto object-cover rounded-lg shadow">
                <p class="text-gray-600 mt-2">Geen afbeeldingen beschikbaar</p>
            </div>
        @endif

        <!-- Details van het Vakantiehuis -->
        <div class="mb-8 bg-gray-50 p-6 rounded-lg shadow">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <p class="text-gray-800"><strong>Naam:</strong> {{ $vakantiehuis->naam }}</p>
                <p class="text-gray-800"><strong>Prijs:</strong> €{{ number_format($vakantiehuis->prijs, 2) }}</p>
                <p class="text-gray-800 md:col-span-2"><strong>Beschrijving:</strong>
                    {{ $vakantiehuis->beschrijving ?? 'Geen beschrijving beschikbaar.' }}
                </p>
                <p class="text-gray-800"><strong>Locatie:</strong> {{ $vakantiehuis->straatnaam }}
                    {{ $vakantiehuis->huisnummer }}, {{ $vakantiehuis->postcode }} {{ $vakantiehuis->stad }}
                </p>
                <p class="text-gray-800"><strong>Aantal Slaapkamers:</strong> {{ $vakantiehuis->slaapkamers }}</p>
                <p class="text-gray-800"><strong>Beschikbaarheid:</strong>
                    <span class="{{ $vakantiehuis->beschikbaarheid ? 'text-green-500' : 'text-red-500' }}">
                        {{ $vakantiehuis->beschikbaarheid ? 'Beschikbaar' : 'Niet beschikbaar' }}
                    </span>
                </p>
            </div>
        </div>

        <!-- Voorzieningen Sectie -->
        <div class="mb-8 bg-gray-50 p-6 rounded-lg shadow">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Voorzieningen</h2>
            <ul class="list-disc pl-6 space-y-2">
                @if ($vakantiehuis->wifi)
                    <li class="text-gray-800">Wi-Fi</li>
                @endif
                @if ($vakantiehuis->zwembad)
                    <li class="text-gray-800">Zwembad</li>
                @endif
                @if ($vakantiehuis->parkeren)
                    <li class="text-gray-800">Parkeerplaats</li>
                @endif
                @if ($vakantiehuis->speeltuin)
                    <li class="text-gray-800">Speeltuin</li>
                @endif
                @if (!$vakantiehuis->wifi && !$vakantiehuis->zwembad && !$vakantiehuis->parkeren && !$vakantiehuis->speeltuin)
                    <li class="text-gray-600 italic">Geen voorzieningen beschikbaar.</li>
                @endif
            </ul>
        </div>

        <!-- Terug naar overzicht en Bewerk Knop -->
        <div class="flex items-center justify-between">
            <a href="{{ route('huizen.index') }}"
                class="inline-block bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition">
                Terug naar overzicht
            </a>

            @if (auth()->check() && auth()->id() == $vakantiehuis->verhuurder_id)
                <a href="{{ route('verhuurder.huizen.edit', $vakantiehuis->id) }}"
                    class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                    Bewerk Huis
                </a>
            @endif
        </div>
    </div>

    <x-footer />
</x-app-layout>
