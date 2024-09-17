<x-app-layout>
    <x-header />

    <div class="min-h-screen bg-green-100 py-16">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">{{ $huis->naam }}</h1>

            <!-- House details -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <img src="{{ $huis->afbeelding ?? 'https://placehold.co/600x400' }}" alt="{{ $huis->naam }}"
                    class="w-full h-96 object-cover rounded-lg mb-4">
                <p><strong>Locatie:</strong> {{ $huis->locatie }}</p>
                <p><strong>Prijs:</strong> € {{ $huis->prijs }}</p>
                <p><strong>Beschrijving:</strong> {{ $huis->beschrijving }}</p>

                <!-- Amenities -->
                <h3 class="mt-6 text-xl font-semibold">Voorzieningen</h3>
                <ul class="list-disc list-inside">
                    @if ($huis->zwembad)
                        <li>Zwembad</li>
                    @endif
                    @if ($huis->wifi)
                        <li>Wi-Fi</li>
                    @endif
                    @if ($huis->spa)
                        <li>Spa</li>
                    @endif
                    @if ($huis->speeltuin)
                        <li>Speeltuin</li>
                    @endif
                </ul>

                <a href="{{ route('verhuurder.huizen.bewerken', $huis->id) }}"
                    class="mt-4 inline-block bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                    Bewerk Vakantiehuis
                </a>
            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
