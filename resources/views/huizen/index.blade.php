<x-app-layout>
    <x-header />

    <div class="flex">
        <!-- Sidebar / Filters -->
        <x-filter :locationsList="$locationsList" />

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">Vakantiehuizen</h1>

            <<<<<<< HEAD @if ($vakantiehuizen->isEmpty())
                =======
                <!-- Search Bar -->
                <form action="{{ route('huizen.index') }}" method="GET" class="mb-6">
                    <div class="flex items-center">
                        <input type="text" name="search" placeholder="Zoek op plaats, buurt of postcode"
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500"
                            value="{{ request()->input('search') }}">
                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded-lg ml-2 hover:bg-green-700 transition">
                            Zoek
                        </button>
                    </div>

                    <!-- Hidden Fields to Submit Filter Values with Search -->
                    <input type="hidden" name="stad" value="{{ request()->input('stad') }}">
                    <input type="hidden" name="postcode" value="{{ request()->input('postcode') }}">
                    <input type="hidden" name="straatnaam" value="{{ request()->input('straatnaam') }}">
                    <input type="hidden" name="min_prijs" value="{{ request()->input('min_prijs') }}">
                    <input type="hidden" name="max_prijs" value="{{ request()->input('max_prijs') }}">
                    <input type="hidden" name="wifi" value="{{ request()->input('wifi') }}">
                    <input type="hidden" name="zwembad" value="{{ request()->input('zwembad') }}">
                    <input type="hidden" name="parkeren" value="{{ request()->input('parkeren') }}">
                    <input type="hidden" name="speeltuin" value="{{ request()->input('speeltuin') }}">
                </form>

                <!-- Results -->
                @if ($huizen->isEmpty())
                    >>>>>>> mikey-backend-backup
                    <p class="text-gray-600">Geen vakantiehuizen beschikbaar.</p>
                @else
                    <!-- List of Vacation Homes -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                        <<<<<<< HEAD @foreach ($vakantiehuizen as $huis)
                            <div class="bg-white p-4 rounded-lg shadow">
                                <!-- Display the image or placeholder if no image exists -->
                                <img src="{{ $huis->images->first()->url ?? 'https://via.placeholder.com/400x300.png?text=Vakantiehuis' }}"
                                    alt="{{ $huis->naam }}" class="w-full h-48 object-cover rounded-t-lg mb-4">

                                <h3 class="text-xl font-bold text-gray-800">{{ $huis->naam }}</h3>
                                <p class="text-gray-600">{{ $huis->postcode }} {{ $huis->stad }}</p>
                                <p class="text-green-600 font-semibold">€{{ $huis->prijs }}</p>
                                <a href="{{ route('huizen.show', $huis->id) }}"
                                    class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Bekijk
                                    details</a>
                                =======
                                @foreach ($huizen as $huis)
                                    <div
                                        class="relative flex flex-col justify-between bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 h-full">
                                        <img src="{{ asset($huis->images->first()->url ?? 'images/placeholder.png') }}"
                                            alt="{{ $huis->naam }}"
                                            class="w-full h-48 object-cover rounded-t-lg mb-4">

                                        <div class="flex-grow">
                                            <h3 class="text-xl font-bold text-gray-800">{{ $huis->naam }}</h3>
                                            <p class="text-gray-600">{{ $huis->postcode }} {{ $huis->stad }},
                                                {{ $huis->straatnaam }}</p>
                                            <p class="text-green-600 font-semibold">€{{ $huis->prijs }}</p>
                                            <div class="mt-2">
                                                @if ($huis->wifi)
                                                    <span class="text-green-500">Wi-Fi</span>
                                                @endif
                                                @if ($huis->zwembad)
                                                    <span class="text-blue-500">Zwembad</span>
                                                @endif
                                                @if ($huis->parkeren)
                                                    <span class="text-gray-500">Parkeren</span>
                                                @endif
                                                @if ($huis->speeltuin)
                                                    <span class="text-yellow-500">Speeltuin</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="flex items-center justify-between mt-4">
                                            <a href="{{ route('huizen.show', $huis->id) }}"
                                                class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                                Bekijk details
                                            </a>

                                            @auth
                                                <form class="absolute bottom-4 right-4 favorite-form"
                                                    data-id="{{ $huis->id }}" method="POST"
                                                    action="{{ route('favorieten.toggle', $huis->id) }}">
                                                    @csrf
                                                    <button type="submit" class="favorite-button text-2xl">
                                                        <i
                                                            class="fas fa-heart {{ $huis->FavorietenChecker(Auth::id()) ? 'text-red-600' : 'text-black' }}"></i>
                                                    </button>
                                                </form>
                                            @endauth
                                        </div>
                                        >>>>>>> mikey-backend-backup
                                        >>>>>>> mikey-backend-backup
                                    </div>
                                @endforeach
                            </div>
                @endif
        </div>
    </div>
</x-app-layout>
