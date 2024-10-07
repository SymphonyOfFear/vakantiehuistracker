<x-app-layout>
    <x-header />

<<<<<<< HEAD
    <div class="min-h-screen bg-green-100 py-16">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">{{ $huisje->naam }}</h1>

            <!-- House details -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <img src="{{ $huisje->afbeelding ?? 'https://placehold.co/600x400' }}" alt="{{ $huisje->naam }}"
                    class="w-full h-96 object-cover rounded-lg mb-4">
                <p><strong>Locatie:</strong> {{ $huisje->locatie }}</p>
                <p><strong>Prijs:</strong> € {{ $huisje->prijs }}</p>
                <p><strong>Aantal slaapkamers:</strong> € {{ $huisje->slaapkamers}}</p>
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
                <p><strong>Beschikbaar:</strong>  
                    @if ($huisje->beschikbaarheid)
                        Beschikbaar
                    @else
                        Niet Beschikbaar
                    @endif
                </p>
            </div>

=======
    <div class="flex">
        <!-- Sidebar -->
        <x-sidebar title="Menu">
            <li><a href="{{ route('verhuurder.dashboard') }}" class="text-gray-700 hover:text-green-600">Dashboard</a>
            </li>
            <li><a href="{{ route('verhuurder.huizen.index') }}"
                    class="text-gray-700 hover:text-green-600">Huizenbeheer</a></li>
            <li><a href="{{ route('recensies.index') }}" class="text-gray-700 hover:text-green-600">Recensies</a></li>
            <li><a href="{{ route('reserveringen.index') }}" class="text-gray-700 hover:text-green-600">Reserveringen</a>
            </li>
            <li><a href="{{ route('favorieten.index') }}" class="text-gray-700 hover:text-green-600">Favorieten</a></li>
        </x-sidebar>

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-6 bg-white">
            <!-- Navigation Breadcrumbs -->
            <nav class="text-gray-500 text-sm mb-4">
                <a href="{{ route('huizen.index') }}" class="hover:text-green-600">Huizen</a> &gt;
                <span>{{ $vakantiehuis->stad }}</span> &gt;
                <span>{{ $vakantiehuis->straatnaam }} {{ $vakantiehuis->huisnummer }}</span>
            </nav>

            <!-- Title and Edit Button -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">{{ $vakantiehuis->naam }}</h1>
                @if (Auth::id() === $vakantiehuis->verhuurder_id)
                    <a href="{{ route('verhuurder.huizen.edit', $vakantiehuis->id) }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Bewerk</a>
                @endif
            </div>

            <!-- Main Image and Additional Images -->
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
                <div id="map" class="w-full h-64 rounded-lg shadow"
                    data-postcode="{{ $vakantiehuis->postcode }}"></div>
                <a href="https://www.google.com/maps/search/?api=1&query={{ $vakantiehuis->postcode }}"
                    class="text-blue-500 hover:underline mt-2 block">Bekijk op Google Maps</a>
            </div>

            <!-- Beschrijving sectie -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h2 class="text-xl font-semibold mb-2">Beschrijving</h2>
                <p class="text-gray-700">{{ $vakantiehuis->beschrijving ?? 'Geen beschrijving beschikbaar.' }}</p>
            </div>

            <!-- Recensies sectie -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h2 class="text-xl font-semibold mb-4">Recensies</h2>
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
                    <!-- Add Review -->
                    <form action="{{ route('recensies.store', $vakantiehuis->id) }}" method="POST" class="mt-4">
                        @csrf
                        <div class="mb-4">
                            <label for="rating" class="block text-gray-700 font-medium">Beoordeling</label>
                            <div id="star-rating" class="flex items-center space-x-1">
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
>>>>>>> mikey-backend
        </div>
    </div>
    <x-footer />
</x-app-layout>
