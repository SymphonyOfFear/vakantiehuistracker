<x-app-layout>
    <div class="flex flex-wrap lg:flex-nowrap justify-between lg:space-x-4">
        <div class="w-full lg:w-1/4 p-4 bg-white shadow-md mb-4 lg:mb-0 rounded-lg">
            <x-filter />
        </div>

        <div class="w-full lg:w-3/4 p-6 bg-white rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-4">Vakantiehuizen</h1>

            <form action="{{ route('huizen.index') }}" method="GET" class="mb-4 flex items-center space-x-4">
                <div class="relative w-full">
                    <input autocomplete="off" type="text" id="stad" name="stad"
                        placeholder="Typ een plaats, buurt of postcode"
                        class="w-full px-6 py-4 border border-gray-300 rounded-md focus:outline-none focus:border-green-500">

                    <div id="stad-suggestions"
                        class="absolute z-10 w-full bg-white shadow-lg border border-gray-200 mt-1 rounded-md max-h-60 overflow-y-auto hidden">
                    </div>
                </div>
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                    Zoeken
                </button>
            </form>

            @if ($huizen->isEmpty())
                <p class="text-gray-600">Geen vakantiehuizen beschikbaar.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                    @foreach ($huizen as $huis)
                        <div
                            class="relative flex flex-col justify-between bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 h-full">
                            <!-- Controleer of er een afbeelding is en toon de URL -->
                            <img src="{{ asset($huis->images->first()->url ?? 'images/placeholder.png') }}"
                                alt="{{ $huis->naam }}" class="w-full h-48 object-cover rounded-t-lg mb-4">

                            <div class="flex-grow">
                                <h3 class="text-xl font-bold text-gray-800">{{ $huis->naam }}</h3>
                                <p class="text-gray-600">{{ $huis->postcode }} {{ $huis->stad }}</p>
                                <p class="text-green-600 font-semibold">€{{ $huis->prijs }}</p>
                            </div>

                            <div class="flex items-center justify-between mt-4">
                                <a href="{{ route('huizen.show', $huis->id) }}"
                                    class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                    Bekijk details
                                </a>

                                @auth
                                    <form class="absolute bottom-4 right-4 favorite-form" data-id="{{ $huis->id }}"
                                        method="POST" action="{{ route('favorieten.toggle', $huis->id) }}">
                                        @csrf
                                        <button type="submit" class="favorite-button text-2xl">
                                            <i
                                                class="fas fa-heart {{ $huis->FavorietenChecker(Auth::id()) ? 'text-red-600' : 'text-black' }}"></i>
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
