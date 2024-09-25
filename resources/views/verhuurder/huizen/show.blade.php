<x-app-layout>
    <x-header />

    <div class="flex">
        <!-- Sidebar -->
        <x-sidebar title="Huizenbeheer">
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                    Huizen</a></li>
        </x-sidebar>

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">{{ $vakantiehuis->name }}</h1>

            <div>
                <p><strong>Locatie:</strong> {{ $vakantiehuis->location }}</p>
                <p><strong>Prijs per nacht:</strong> €{{ $vakantiehuis->price }}</p>
                <p><strong>Aantal slaapkamers:</strong> {{ $vakantiehuis->bedrooms }}</p>
                <p><strong>Voorzieningen:</strong> {{ implode(', ', $vakantiehuis->amenities) }}</p>

                @if ($vakantiehuis->photo)
                    <img src="{{ asset('storage/' . $vakantiehuis->photo) }}" alt="Vakantiehuis" class="mt-4">
                @endif

                <a href="{{ route('verhuurder.huizen.edit', $vakantiehuis->id) }}"
                    class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Bewerk Huis</a>
            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
