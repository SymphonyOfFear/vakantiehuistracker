<x-app-layout>
    <x-header />

    <div class="container mx-auto px-4 py-8">
        <!-- Navigatie breadcrumbs -->
        <nav class="text-gray-500 text-sm mb-4">
            <a href="{{ route('huizen.index') }}" class="hover:text-green-600">Huizen</a> &gt;
            <a href="#" class="hover:text-green-600">{{ $vakantiehuis->stad }}</a> &gt;
            <span>{{ $vakantiehuis->straatnaam }} {{ $vakantiehuis->huisnummer }}</span>
        </nav>

        <!-- Hoofdtitel en knopjes -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ $vakantiehuis->naam }}</h1>
            <div class="flex items-center">
                <!-- Favorite button -->
                <a href="{{ route('favorieten.add', $vakantiehuis->id) }}"
                    class="text-xl cursor-pointer hover:text-red-600 favorite-button">
                    <i
                        class="fas fa-heart {{ $vakantiehuis->isFavoritedBy(auth()->user()->id) ? 'text-red-600' : 'text-black' }}"></i>
                </a>

                <!-- Gemiddelde rating (niet-bewerkbaar) -->
                <div class="ml-4" id="average-rating">
                    @php $averageRating = $vakantiehuis->recensies->avg('rating'); @endphp
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star {{ $i <= $averageRating ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                    @endfor
                </div>
            </div>
        </div>

        <!-- Hoofdbeeld en extra afbeeldingen -->
        @if ($vakantiehuis->images->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <!-- Hoofdafbeelding -->
                <div class="md:col-span-2">
                    <img src="{{ $vakantiehuis->images->first()->url }}" alt="{{ $vakantiehuis->naam }}"
                        class="w-full h-auto object-cover rounded-lg">
                </div>
                <!-- Extra afbeeldingen -->
                <div class="md:col-span-2 grid grid-cols-2 gap-2">
                    @foreach ($vakantiehuis->images->slice(1) as $image)
                        <img src="{{ $image->url }}" alt="{{ $vakantiehuis->naam }}"
                            class="w-full h-40 object-cover rounded-lg">
                    @endforeach
                </div>
            </div>
        @else
            <div class="mb-6">
                <img src="https://via.placeholder.com/600x400.png?text=Geen+Afbeeldingen+Beschikbaar"
                    alt="Geen afbeeldingen beschikbaar" class="w-full h-auto object-cover rounded-lg">
            </div>
        @endif

        <!-- Kaart sectie -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-2">Locatie op de kaart</h2>
            <!-- Map div met data-latitude en data-longitude attributen -->
            <div id="map" class="w-full h-64 rounded-lg shadow" data-latitude="{{ $vakantiehuis->latitude }}"
                data-longitude="{{ $vakantiehuis->longitude }}">
            </div>

            <!-- Google Maps Link -->
            <a href="https://www.google.com/maps/search/?api=1&query={{ $vakantiehuis->latitude && $vakantiehuis->longitude ? $vakantiehuis->latitude . ',' . $vakantiehuis->longitude : $vakantiehuis->postcode }}"
                class="text-blue-500 hover:underline mt-2 block">Bekijk op Google Maps</a>
        </div>

        <!-- Beschrijving sectie -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-2">Beschrijving</h2>
            <p class="text-gray-700">{{ $vakantiehuis->beschrijving ?? 'Geen beschrijving beschikbaar.' }}</p>
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

            <!-- Recensie toevoegen -->
            @auth
                <form action="{{ route('recensies.store', $vakantiehuis->id) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-4">
                        <label for="rating" class="block text-gray-700 font-medium">Beoordeling</label>
                        <div id="star-rating" class="flex items-center space-x-1"
                            data-user-rating="{{ $vakantiehuis->userRating(auth()->id()) }}">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa fa-star text-gray-300 cursor-pointer {{ $vakantiehuis->userRating(auth()->id()) >= $i ? 'text-yellow-500' : '' }}"
                                    data-value="{{ $i }}"></i>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating-input"
                            value="{{ $vakantiehuis->userRating(auth()->id()) }}">
                    </div>
                    <div class="mb-4">
                        <label for="comment" class="block text-gray-700 font-medium">Opmerking</label>
                        <textarea name="comment" id="comment" rows="4"
                            class="w-full mt-1 p-2 border border-gray-300 rounded-md resize-none" required></textarea>
                    </div>
                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Plaats
                        Recensie</button>
                </form>
            @endauth
        </div>

        <!-- Terug naar overzicht knop -->
        <div>
            <a href="{{ route('huizen.index') }}"
                class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">Terug naar
                overzicht</a>
        </div>
    </div>

    <x-footer />
</x-app-layout>
