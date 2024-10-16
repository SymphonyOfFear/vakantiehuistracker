<x-app-layout>
    <div class="container mx-auto px-4 py-8">

        <!-- Breadcrumb Navigation -->
        <nav class="text-gray-500 text-sm mb-4">
            <a href="{{ route('huizen.index') }}" class="hover:text-green-600">Huizen</a> &gt;
            <span>{{ $vakantiehuis->stad }}</span> &gt;
            <span>{{ $vakantiehuis->straatnaam }} {{ $vakantiehuis->huisnummer }}</span>
        </nav>

        <!-- Property Title and Action Buttons -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ $vakantiehuis->naam }}</h1>
            @if (Auth::id() === $vakantiehuis->verhuurder_id)
                <a href="{{ route('verhuurder.huizen.edit', $vakantiehuis->id) }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    Bewerk
                </a>
            @endif
        </div>

        <!-- Image Gallery Section -->
        @if ($vakantiehuis->images->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="col-span-2">
                    <img src="{{ $vakantiehuis->images->first()->url }}" alt="{{ $vakantiehuis->naam }}"
                        class="w-full h-auto object-cover rounded-lg shadow">
                </div>
                <div class="col-span-2 grid grid-cols-2 gap-2">
                    @foreach ($vakantiehuis->images->slice(1) as $image)
                        <img src="{{ $image->url }}" alt="{{ $vakantiehuis->naam }}"
                            class="w-full h-40 object-cover rounded-lg shadow">
                    @endforeach
                </div>
            </div>
        @else
            <div class="mb-6">
                <img src="https://via.placeholder.com/600x400.png?text=Geen+Afbeeldingen+Beschikbaar"
                    alt="Geen afbeeldingen beschikbaar" class="w-full h-auto object-cover rounded-lg shadow">
            </div>
        @endif


        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-2">Eigenschappen</h2>
            <ul class="text-gray-700 space-y-2">
                <li>Prijs: <strong>€{{ number_format($vakantiehuis->prijs, 2) }}</strong></li>
                <li>Slaapkamers: <strong>{{ $vakantiehuis->slaapkamers }}</strong></li>
                <li>Stad: <strong>{{ $vakantiehuis->stad }}</strong></li>
                <li>Straat: <strong>{{ $vakantiehuis->straatnaam }} {{ $vakantiehuis->huisnummer }}</strong></li>
            </ul>
            <h2 class="text-xl font-semibold mb-2">Voorzieningen</h2>
            <ul class="text-gray-700 space-y-2">
                <li>Wifi: <strong>
                        @if ($vakantiehuis->wifi == 1)
                            Ja
                        @else
                            Nee
                        @endif
                    </strong></li>

                <li>Zwembad: <strong>
                        @if ($vakantiehuis->zwembad == 1)
                            Ja
                        @else
                            Nee
                        @endif
                    </strong></li>

                <li>Parkeren: <strong>
                        @if ($vakantiehuis->parkeren == 1)
                            Ja
                        @else
                            Nee
                        @endif
                    </strong></li>

                <li>Speeltuin: <strong>
                        @if ($vakantiehuis->speeltuin == 1)
                            Ja
                        @else
                            Nee
                        @endif
                    </strong></li>
            </ul>
        </div>

        <!-- Map Section -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-2">Locatie op de kaart</h2>
            <div id="map" class="w-full h-64 rounded-lg shadow" data-lat="{{ $vakantiehuis->latitude }}"
                data-lon="{{ $vakantiehuis->longitude }}"></div>
            <a href="https://www.google.com/maps/search/?api=1&query={{ $vakantiehuis->latitude }},{{ $vakantiehuis->longitude }}"
                class="text-blue-500 hover:underline mt-2 block">
                Bekijk op Google Maps
            </a>
        </div>

        <!-- Description Section -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-2">Beschrijving</h2>
            <p class="text-gray-700">{{ $vakantiehuis->beschrijving ?? 'Geen beschrijving beschikbaar.' }}</p>
        </div>

        <!-- Reviews Section -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-4">Recensies</h2>
            <div class="space-y-4">
                @foreach ($vakantiehuis->recensies as $recensie)
                    <div class="border-b border-gray-200 py-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-800 font-semibold">{{ $recensie->user->name }}</span>
                            <span class="text-sm text-gray-500">{{ $recensie->created_at->format('d-m-Y') }}</span>
                        </div>
                        <p class="text-gray-700">{{ $recensie->comment }}</p>
                        <div class="flex items-center">
                            <span class="text-yellow-500">Rating: </span>
                            <div class="ml-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i
                                        class="fa fa-star {{ $i <= $recensie->rating ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Add Review Form -->
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
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                        Plaats Recensie
                    </button>
                </form>
            @endauth
        </div>

        <!-- Back to Overview Button -->
        <div>
            <a href="{{ route('huizen.index') }}"
                class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                Terug naar overzicht
            </a>
        </div>
    </div>
</x-app-layout>
