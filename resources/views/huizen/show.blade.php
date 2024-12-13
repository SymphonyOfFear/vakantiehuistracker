<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <nav class="text-gray-500 text-sm mb-4">
            <a href="{{ route('huizen.index') }}" class="hover:text-green-600">Huizen</a> &gt;
            <a href="#" class="hover:text-green-600">{{ $vakantiehuis->stad }}</a> &gt;
            <span>{{ $vakantiehuis->straatnaam }} {{ $vakantiehuis->huisnummer }}</span>
        </nav>

        <div class="flex flex-wrap md:flex-nowrap mb-8">
            <!-- Slideshow -->
            <div class="w-full md:w-1/2 lg:w-2/3 mb-4">
                <div id="slideshow" class="relative overflow-hidden rounded-lg shadow-lg">
                    @foreach ($vakantiehuis->images as $image)
                        <div class="slide {{ $loop->first ? 'active' : '' }}"
                            style="display: {{ $loop->first ? 'block' : 'none' }};">
                            <img src="{{ asset($image->url) }}" alt="{{ $vakantiehuis->naam }}"
                                class="w-full h-80 object-cover">
                        </div>
                    @endforeach
                    <button id="prev"
                        class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full">&#10094;</button>
                    <button id="next"
                        class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full">&#10095;</button>
                </div>
            </div>

            <!-- Property Details -->
            <div class="w-full md:w-1/2 lg:w-1/3 bg-white p-6 rounded-lg shadow-md">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $vakantiehuis->naam }}</h1>
                <p class="text-gray-600 mb-2">{{ $vakantiehuis->straatnaam }} {{ $vakantiehuis->huisnummer }},
                    {{ $vakantiehuis->stad }}</p>
                <p class="text-green-600 font-semibold text-lg mb-4">€{{ number_format($vakantiehuis->prijs, 2) }} per
                    nacht</p>

                <h2 class="font-semibold text-lg mb-2">Voorzieningen:</h2>
                <ul class="text-gray-700 mb-4 space-y-1">
                    <li>Wi-Fi: {{ $vakantiehuis->wifi ? 'Ja' : 'Nee' }}</li>
                    <li>Zwembad: {{ $vakantiehuis->zwembad ? 'Ja' : 'Nee' }}</li>
                    <li>Parkeren: {{ $vakantiehuis->parkeren ? 'Ja' : 'Nee' }}</li>
                    <li>Speeltuin: {{ $vakantiehuis->speeltuin ? 'Ja' : 'Nee' }}</li>
                </ul>

                <!-- Favorieten Knop -->
                @auth
                    <form class="favoriet-form" data-id="{{ $vakantiehuis->id }}" method="POST"
                        action="{{ route('favorieten.toggle', $vakantiehuis->id) }}">
                        @csrf
                        <button type="submit" class="text-2xl">
                            <i
                                class="fas fa-heart {{ $vakantiehuis->FavorietenChecker(Auth::id()) ? 'text-red-600' : 'text-gray-400' }}"></i>
                        </button>
                    </form>
                @endauth
            </div>
        </div>

        <!-- Map -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-2">Locatie op de kaart</h2>
            <div id="map" class="w-full h-64 rounded-lg shadow" data-lat="{{ $vakantiehuis->latitude }} "
                data-lon="{{ $vakantiehuis->longitude }}"></div>
            <a href="https://www.google.com/maps/search/?api=1&query={{ $vakantiehuis->latitude }},{{ $vakantiehuis->longitude }}"
                class="text-blue-500 hover:underline mt-2 block">Bekijk op Google Maps</a>
        </div>

        <!-- Description -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">Beschrijving</h2>
            <p class="text-gray-700">{{ $vakantiehuis->beschrijving ?? 'Geen beschrijving beschikbaar.' }}</p>
        </div>

        <!-- Recensies Section -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-4">Recensies</h2>

            @foreach ($vakantiehuis->recensies as $recensie)
                <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                    <div class="flex justify-between items-center border-b pb-2">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">{{ $recensie->user->name }}</h3>
                            <span class="text-sm text-gray-500">{{ $recensie->created_at->format('d-m-Y') }}</span>
                        </div>
                        <div class="flex items-center text-yellow-400">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa{{ $i <= $recensie->rating ? 's' : 'r' }} fa-star"></i>
                            @endfor
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="text-gray-700 font-semibold">opmerking</p>
                        <p class="text-gray-600">{{ $recensie->comment }}</p>
                    </div>
                </div>
            @endforeach

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Add Recensie Form -->
            @auth
                <form action="{{ route('recensies.store', $vakantiehuis->id) }}" method="POST" class="mt-4">
                    @csrf

                    <div class="mb-4">
                        <label for="rating" class="block text-gray-700 font-medium">Beoordeling</label>
                        <div id="star-rating" class="flex items-center space-x-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa fa-star text-gray-300 cursor-pointer" data-value="{{ $i }}"></i>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating-input">
                    </div>
                    <div class="mb-4">
                        <label for="opmerking" class="block text-gray-700 font-medium">Opmerking</label>
                        <textarea name="opmerking" id="opmerking" rows="4"
                            class="w-full mt-1 p-2 border border-gray-300 rounded-md resize-none" required></textarea>
                    </div>
                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">Plaats
                        Recensie</button>
                </form>
            @endauth
        </div>

        <!-- Reservering Knop -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-4">Reserveren</h2>
            <p class="text-gray-700 mb-4">Wil je dit vakantiehuis reserveren? Klik op de onderstaande knop om een reservering te maken.</p>
            <a href="{{ route('reserveringen.create', $vakantiehuis->id) }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">Maak een reservering</a>
        </div>

        <!-- Back to overview -->
        <div>
            <a href="{{ route('huizen.index') }}"
                class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">Terug naar overzicht</a>
        </div>
    </div>
</x-app-layout>
