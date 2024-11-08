<x-app-layout>
    <div class="flex flex-col lg:flex-row p-6 gap-4">
    
        <form action="{{ route('huizen.index') }}" method="GET" class="lg:w-1/4 bg-white shadow-md p-4 rounded-lg">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Filters en Zoekopdracht</h2>
            
            <div class="mb-4">
                <input type="text" name="zoekopdracht" placeholder="Zoek op plaats, buurt of postcode" value="{{ request('zoekopdracht') }}" class="w-full p-3 border border-gray-300 rounded-md focus:border-green-500" autocomplete="off">
            </div>
            
            <div class="border-t border-gray-200 my-4"></div>

            <div class="mb-4">
                <label class="block font-semibold text-black mb-2">Prijs (€)</label>
                <div class="flex gap-2">
                    <input type="number" name="min_prijs" placeholder="Min" value="{{ request('min_prijs', 0) }}" min="0" max="10000" class="w-1/2 p-2 border border-gray-300 rounded-md" autocomplete="off">
                    <input type="number" name="max_prijs" placeholder="Max" value="{{ request('max_prijs', 10000) }}" min="0" max="10000" class="w-1/2 p-2 border border-gray-300 rounded-md" autocomplete="off">
                </div>
            </div>

            <div class="border-t border-gray-200 my-4"></div>

            <div class="mb-4">
                <label class="block font-semibold text-black mb-2">Locatie</label>
                <input id="postcode" type="text" name="postcode" placeholder="Postcode" value="{{ request('postcode') }}" class="w-full p-3 border border-gray-300 rounded-md mb-2" autocomplete="off">
                <input id="straatnaam" type="text" name="straatnaam" placeholder="Straatnaam" value="{{ request('straatnaam') }}" class="w-full p-3 border border-gray-300 rounded-md mb-2"  autocomplete="off">
                <input id="stad" type="text" name="stad" placeholder="Stad" value="{{ request('stad') }}" class="w-full p-3 border border-gray-300 rounded-md" autocomplete="off">
            </div>

            <div class="border-t border-gray-200 my-4"></div>

            <div class="mb-4">
                <label class="block font-semibold text-black mb-2">Voorzieningen</label>
                <div class="flex gap-4 flex-wrap">
                    <label><input type="checkbox" name="wifi" value="1" {{ request('wifi') ? 'checked' : '' }}> Wi-Fi</label>
                    <label><input type="checkbox" name="zwembad" value="1" {{ request('zwembad') ? 'checked' : '' }}> Zwembad</label>
                    <label><input type="checkbox" name="parkeren" value="1" {{ request('parkeren') ? 'checked' : '' }}> Parkeren</label>
                    <label><input type="checkbox" name="speeltuin" value="1" {{ request('speeltuin') ? 'checked' : '' }}> Speeltuin</label>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Pas filters toe</button>
            </div>
        </form>

        <div class="w-full lg:w-3/4">
            <h1 class="text-2xl font-bold mb-6">Vakantiehuizen</h1>

            @if($huizen->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($huizen as $vakantiehuis)
                        <div class="bg-white shadow-md rounded-lg p-4 hover:shadow-lg transition relative">
                            <img src="{{ asset($vakantiehuis->images->first()->url) }}" alt="{{ $vakantiehuis->naam }}" class="w-full h-48 object-cover rounded-md mb-4">
                            
                            <div class="flex justify-between items-start">
                                <h2 class="text-xl font-semibold mb-2">{{ $vakantiehuis->naam }}</h2>
                                @auth
                                    <form class="favoriet-form" data-id="{{ $vakantiehuis->id }}" method="POST" action="{{ route('favorieten.toggle', $vakantiehuis->id) }}">
                                        @csrf
                                        <button type="submit" class="text-xl text-gray-400 hover:text-red-600 transition">
                                            <i class="fas fa-heart {{ $vakantiehuis->FavorietenChecker(Auth::id()) ? 'text-red-600' : 'text-gray-400' }}"></i>
                                        </button>
                                    </form>
                                @endauth
                            </div>

                            <p class="text-gray-600 mb-1">{{ $vakantiehuis->stad }}, {{ $vakantiehuis->straatnaam }}</p>
                            <p class="text-green-600 font-bold">€{{ number_format($vakantiehuis->prijs, 2) }} per nacht</p>

                            <div class="mt-2">
                                <span class="font-semibold">Voorzieningen:</span>
                                <ul class="list-disc list-inside text-gray-600">
                                    <li>Wi-Fi: {{ $vakantiehuis->wifi ? 'Ja' : 'Nee' }}</li>
                                    <li>Zwembad: {{ $vakantiehuis->zwembad ? 'Ja' : 'Nee' }}</li>
                                    <li>Parkeren: {{ $vakantiehuis->parkeren ? 'Ja' : 'Nee' }}</li>
                                    <li>Speeltuin: {{ $vakantiehuis->speeltuin ? 'Ja' : 'Nee' }}</li>
                                </ul>
                            </div>

                            <a href="{{ route('huizen.show', $vakantiehuis->id) }}" class="text-blue-600 mt-4 inline-block">Bekijk meer</a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 mt-6">Geen vakantiehuizen beschikbaar.</p>
            @endif
        </div>
    </div>
</x-app-layout>
