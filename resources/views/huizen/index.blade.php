<x-app-layout>
    <div class="flex flex-col lg:flex-row p-6">

        <form action="{{ route('huizen.index') }}" method="GET" class="lg:w-1/4 bg-white shadow-lg p-4 rounded-lg">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Filters en Zoekopdracht</h2>

            <div class="mb-4">
                <input type="text" name="zoekopdracht" placeholder="Zoek op plaats, buurt of postcode" value="{{ request('zoekopdracht') }}" class="w-full p-3 border border-gray-300 rounded-md focus:border-green-500 text-lg" autocomplete="off">
                <button type="submit" class="mt-2 w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Zoek</button>
            </div>
            <div class="border-neutral-30 mt-6 border-b pb-6"></div>

            <div class="border-neutral-30 mt-6 border-b pb-6">
                <div class="font-semibold text-black mb-4">Prijs (€)</div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center">
                        <label for="min-prijs-input" class="text-sm font-medium text-gray-700 mr-2">Min:</label>
                        <input type="number" id="min-prijs-input" name="min_prijs" value="{{ request('min_prijs', 0) }}" min="0" max="10000" class="w-full p-2 border border-gray-300 rounded-md text-lg" autocomplete="off">
                    </div>
                    <div class="flex items-center">
                        <label for="max-prijs-input" class="text-sm font-medium text-gray-700 mr-2">Max:</label>
                        <input type="number" id="max-prijs-input" name="max_prijs" value="{{ request('max_prijs', 10000) }}" min="0" max="10000" class="w-full p-2 border border-gray-300 rounded-md text-lg" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="border-neutral-30 mt-6 border-b pb-6">
                <div class="font-semibold text-black mb-4">Locatie</div>
                <div class="mb-4">
                    <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode</label>
                    <input type="text" id="postcode" name="postcode" value="{{ request('postcode') }}" class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:border-green-500 text-lg" autocomplete="off">
                </div>
                <div class="mb-4">
                    <label for="straatnaam" class="block text-sm font-medium text-gray-700">Straatnaam</label>
                    <input type="text" id="straatnaam" name="straatnaam" value="{{ request('straatnaam') }}" class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:border-green-500 text-lg" autocomplete="off">
                </div>
                <div class="mb-4 relative">
                    <label for="stad" class="block text-sm font-medium text-gray-700">Stad</label>
                    <input type="text" id="stad" name="stad" value="{{ request('stad') }}" placeholder="Typ een plaats" class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:border-green-500 text-lg" autocomplete="off">
                    <div id="stad-suggestions" class="absolute z-10 w-full bg-white shadow-lg border border-gray-200 mt-1 rounded-md max-h-60 overflow-y-auto hidden"></div>
                </div>
            </div>

            <div class="border-neutral-30 mt-6 border-b pb-6">
                <div class="font-semibold text-black mb-4">Voorzieningen</div>
                <div class="space-y-2">
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

        <div class="w-full lg:w-3/4 p-6">
            <h1 class="text-2xl font-bold mb-4">Vakantiehuizen</h1>

            @if($huizen->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($huizen as $vakantiehuis)
                        <div class="bg-white shadow rounded-lg p-4">
                            <img src="{{ asset($vakantiehuis->images->first()->url) }}" alt="{{ $vakantiehuis->naam }}" class="w-full h-48 object-cover rounded-md mb-4">
                            <h2 class="text-xl font-semibold mb-2">{{ $vakantiehuis->naam }}</h2>
                            <p class="text-gray-600">{{ $vakantiehuis->stad }}, {{ $vakantiehuis->straatnaam }}</p>
                            <p class="text-green-600 font-bold mt-2">€{{ number_format($vakantiehuis->prijs, 2) }} per nacht</p>


                            <div class="mt-4 text-gray-600 text-sm">
                                <p><strong>Voorzieningen:</strong></p>
                                <ul class="list-disc pl-4">
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
