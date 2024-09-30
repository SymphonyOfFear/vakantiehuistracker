<x-app-layout>
    <x-header />

    <div class="min-h-screen bg-green-100 py-16">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">{{ $huisje->naam }}</h1>

            <!-- House details -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <img src="{{ $huisje->afbeelding ?? 'https://placehold.co/600x400' }}" alt="{{ $huisje->naam }}"
                    class="w-full h-96 object-cover rounded-lg mb-4">
                <p><strong>Locatie:</strong> {{ $huisje->locatie }}</p>
                <p><strong>Prijs:</strong> € {{ $huisje->prijs }}</p>
                {{-- <p><strong>Beschrijving:</strong> {{ $huisje->beschrijving }}</p> --}}

                <!-- Amenities -->
                <h3 class="mt-6 text-xl font-semibold">Voorzieningen</h3>
                <ul class="list-disc list-inside">
                    @if ($huisje->zwembad)
                        <li>Zwembad</li>
                    @endif
                    @if ($huisje->wifi)
                        <li>Wi-Fi</li>
                    @endif
                    @if ($huisje->spa)
                        <li>Spa</li>
                    @endif
                    @if ($huisje->speeltuin)
                        <li>Speeltuin</li>
                    @endif
                </ul>
            </div>

        </div>
    </div>
    <x-footer />
</x-app-layout>
