<x-app-layout>
    <div class="flex flex-col lg:flex-row justify-between space-y-6 lg:space-y-0 lg:space-x-4">
        <!-- Filter Sidebar -->
        <div class="w-full lg:w-1/4">
            <x-filter />
        </div>

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-6 bg-white rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-4">Vakantiehuizen</h1>

            <!-- Search Form -->
            <form action="{{ route('huizen.index') }}" method="GET" class="mb-6 flex space-x-2">
                <input type="text" name="search" placeholder="Zoek op plaats, buurt of postcode" class="w-full p-2 border border-gray-300 rounded-md focus:border-green-500" value="{{ request('search') }}">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Zoek</button>

                <!-- Hidden Filter Fields -->
                <input type="hidden" name="stad" value="{{ request('stad') }}">
                <input type="hidden" name="postcode" value="{{ request('postcode') }}">
                <input type="hidden" name="straatnaam" value="{{ request('straatnaam') }}">
                <input type="hidden" name="min_prijs" value="{{ request('min_prijs') }}">
                <input type="hidden" name="max_prijs" value="{{ request('max_prijs') }}">
                <input type="hidden" name="wifi" value="{{ request('wifi') }}">
                <input type="hidden" name="zwembad" value="{{ request('zwembad') }}">
                <input type="hidden" name="parkeren" value="{{ request('parkeren') }}">
                <input type="hidden" name="speeltuin" value="{{ request('speeltuin') }}">
            </form>

            <!-- Listings -->
            @if ($huizen->isEmpty())
                <p class="text-gray-600">Geen vakantiehuizen beschikbaar.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($huizen as $huis)
                        <div class="flex flex-col bg-white rounded-lg shadow-lg hover:shadow-xl transition p-4">
                            <img src="{{ asset($huis->images->first()->url ?? 'images/placeholder.png') }}" alt="{{ $huis->naam }}" class="w-full h-48 object-cover rounded-t-lg mb-4">

                            <h3 class="text-xl font-bold text-gray-800">{{ $huis->naam }}</h3>
                            <p class="text-gray-600">{{ $huis->postcode }} {{ $huis->stad }}, {{ $huis->straatnaam }}</p>
                            <p class="text-green-600 font-semibold">€{{ $huis->prijs }}</p>

                            <!-- Amenities -->
                            <div class="mt-2 flex space-x-2 text-sm">
                                @if ($huis->wifi) <span class="text-green-500">Wi-Fi</span> @endif
                                @if ($huis->zwembad) <span class="text-blue-500">Zwembad</span> @endif
                                @if ($huis->parkeren) <span class="text-gray-500">Parkeren</span> @endif
                                @if ($huis->speeltuin) <span class="text-yellow-500">Speeltuin</span> @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-4 flex justify-between">
                                <a href="{{ route('huizen.show', $huis->id) }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Bekijk details</a>

                                @auth
                                    <form class="favorite-form" method="POST" action="{{ route('favorieten.toggle', $huis->id) }}">
                                        @csrf
                                        <button type="submit" class="text-2xl">
                                            <i class="fas fa-heart {{ $huis->FavorietenChecker(Auth::id()) ? 'text-red-600' : 'text-gray-500' }}"></i>
                                        </button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
