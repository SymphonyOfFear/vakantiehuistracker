<x-app-layout>
    <x-header />

    <div class="container mx-auto px-4 py-8">
        <!-- Navigatie breadcrumbs -->
        <nav class="text-gray-500 text-sm mb-4">
            <a href="{{ route('huizen.index') }}" class="hover:text-green-600">Huizen</a> &gt;
            <a href="#" class="hover:text-green-600">{{ $vakantiehuis->stad }}</a> &gt;
            <span>{{ $vakantiehuis->straatnaam }} {{ $vakantiehuis->huisnummer }}</span>
        </nav>

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ $vakantiehuis->naam }}</h1>
            <div>
                @if (Auth::id() === $vakantiehuis->verhuurder_id)
                    <a href="{{ route('verhuurder.huizen.edit', $vakantiehuis->id) }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Bewerk</a>
                @endif
                <a href="{{ route('favorieten.add', $vakantiehuis->id) }}"
                    class="ml-2 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">Voeg toe aan
                    favorieten</a>
            </div>
        </div>

        @if ($vakantiehuis->images->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="md:col-span-2">
                    <img src="{{ $vakantiehuis->images->first()->url }}" alt="{{ $vakantiehuis->naam }}"
                        class="w-full h-auto object-cover rounded-lg shadow-md transition-transform transform hover:scale-105">
                </div>
                <div class="md:col-span-2 grid grid-cols-2 gap-2">
                    @foreach ($vakantiehuis->images->slice(1) as $image)
                        <img src="{{ $image->url }}" alt="{{ $vakantiehuis->naam }}"
                            class="w-full h-40 object-cover rounded-lg shadow-md transition-transform transform hover:scale-105">
                    @endforeach
                </div>
            </div>
        @else
            <div class="mb-6">
                <img src="https://via.placeholder.com/600x400.png?text=Geen+Afbeeldingen+Beschikbaar"
                    alt="Geen afbeeldingen beschikbaar" class="w-full h-auto object-cover rounded-lg shadow-md">
            </div>
        @endif

        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-2">Locatie op de kaart</h2>
            <div id="map" class="w-full h-64 rounded-lg shadow" data-lat="{{ $vakantiehuis->latitude }}"
                data-lon="{{ $vakantiehuis->longitude }}"></div>
            <a href="https://www.google.com/maps/search/?api=1&query={{ $vakantiehuis->latitude }},{{ $vakantiehuis->longitude }}"
                class="text-blue-500 hover:underline mt-2 block">Bekijk op Google Maps</a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">Beschrijving</h2>
            <p class="text-gray-700">{{ $vakantiehuis->beschrijving ?? 'Geen beschrijving beschikbaar.' }}</p>
        </div>

        <!-- Kenmerken sectie -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-2">Kenmerken</h2>
            <table class="w-full text-left table-auto">
                <tr class="border-b">
                    <th class="py-2 px-4 text-gray-600">Prijs</th>
                    <td class="py-2 px-4 text-gray-800">€{{ $vakantiehuis->prijs }}</td>
                </tr>
                <tr class="border-b">
                    <th class="py-2 px-4 text-gray-600">Slaapkamers</th>
                    <td class="py-2 px-4 text-gray-800">{{ $vakantiehuis->slaapkamers }}</td>
                </tr>
                <tr class="border-b">
                    <th class="py-2 px-4 text-gray-600">Beschikbaarheid</th>
                    <td class="py-2 px-4 text-gray-800">
                        {{ $vakantiehuis->beschikbaarheid ? 'Beschikbaar' : 'Niet beschikbaar' }}</td>
                </tr>
                <tr class="border-b">
                    <th class="py-2 px-4 text-gray-600">Locatie</th>
                    <td class="py-2 px-4 text-gray-800">{{ $vakantiehuis->straatnaam }}
                        {{ $vakantiehuis->huisnummer }}, {{ $vakantiehuis->postcode }} {{ $vakantiehuis->stad }}</td>
                </tr>
            </table>
        </div>

        <!-- Commentaarsectie -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-4">Recensies</h2>
            <!-- Toon alle recensies -->
            @foreach ($vakantiehuis->recensies as $recensie)
                <div class="border-b border-gray-200 py-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-800 font-semibold">{{ $recensie->user->name }}</span>
                        <span class="text-sm text-gray-500">{{ $recensie->created_at->format('d-m-Y') }}</span>
                    </div>
                    <p class="text-gray-700">{{ $recensie->comment }}</p>
                    <p class="text-yellow-500">Rating: {{ $recensie->rating }}/5</p>
                </div>
            @endforeach

            @auth
                <form action="{{ route('recensies.store', $vakantiehuis->id) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-4">
                        <label for="rating" class="block text-gray-700 font-medium">Beoordeling</label>
                        <div id="star-rating" class="flex items-center space-x-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa fa-star text-gray-300 cursor-pointer {{ $vakantiehuis->Beoordeling(auth()->id()) >= $i ? 'text-yellow-500' : '' }}"
                                    data-value="{{ $i }}"></i>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating-input"
                            value="{{ $vakantiehuis->Beoordeling(auth()->id()) }}">
                    </div>
                    <div class="mb-4">
                        <label for="comment" class="block text-gray-700 font-medium">Opmerking</label>
                        <textarea name="comment" id="comment" rows="4"
                            class="w-full mt-1 p-2 border border-gray-300 rounded-md resize-none" required></textarea>
                    </div>
                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-700 transition-transform transform hover:scale-105">Plaats
                        Recensie</button>
                </form>
            @endauth
        </div>

        <div>
            <a href="{{ route('huizen.index') }}"
                class="bg-gray-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-gray-700 transition-transform transform hover:scale-105">Terug naar overzicht</a>
        </div>
    </div>
</x-app-layout>
