<div class="w-full bg-white p-4 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4 text-gray-800">Filters</h2>

    <form action="{{ route('huizen.index') }}" method="GET">

        <!-- Stad -->
        <div class="mb-4">
            <label for="stad" class="block text-sm font-medium text-gray-700">Stad</label>
            <select id="stad" name="stad" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                <option value="">Selecteer een stad</option>
                @foreach ($locationsList as $locatie)
                    <option value="{{ $locatie }}">{{ $locatie }}</option>
                @endforeach
            </select>
        </div>

        <!-- Radius -->
        <div class="mb-4">
            <label for="radius" class="block text-sm font-medium text-gray-700">Radius (km)</label>
            <select id="radius" name="radius" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                <option value="">Selecteer een radius</option>
                <option value="10">10 km</option>
                <option value="25">25 km</option>
                <option value="35">35 km</option>
                <option value="50">50 km</option>
                <option value="75">75 km</option>
                <option value="100">100 km</option>
            </select>
        </div>

        <!-- Postcode -->
        <div class="mb-4">
            <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode</label>
            <input type="text" id="postcode" name="postcode"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md">
        </div>

        <!-- Straatnaam -->
        <div class="mb-4">
            <label for="straatnaam" class="block text-sm font-medium text-gray-700">Straatnaam</label>
            <input type="text" id="straatnaam" name="straatnaam"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md">
        </div>

        <!-- Huisnummer -->
        <div class="mb-4">
            <label for="huisnummer" class="block text-sm font-medium text-gray-700">Huisnummer</label>
            <input type="text" id="huisnummer" name="huisnummer"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md">
        </div>

        <!-- Prijsbereik Slider -->
        <div class="mb-4">
            <label for="prijs" class="block text-sm font-medium text-gray-700">Prijsbereik (€)</label>
            <div class="flex items-center space-x-2">
                <span id="min-prijs-label" class="text-gray-700">€0</span>
                <input type="range" id="min_prijs" name="min_prijs" min="0" max="1000" value="0"
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md" oninput="updatePrijsLabels()">
                <span id="max-prijs-label" class="text-gray-700">€1000</span>
                <input type="range" id="max_prijs" name="max_prijs" min="0" max="1000" value="1000"
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md" oninput="updatePrijsLabels()">
            </div>
        </div>

        <!-- Voorzieningen -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-600">Voorzieningen</label>
            <div class="flex flex-col space-y-3 mt-2">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="wifi" value="1"
                        class="text-green-600 focus:ring-green-500 rounded border-gray-300">
                    <span class="ml-2 text-gray-700">Wi-Fi</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="zwembad" value="1"
                        class="text-green-600 focus:ring-green-500 rounded border-gray-300">
                    <span class="ml-2 text-gray-700">Zwembad</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="parkeren" value="1"
                        class="text-green-600 focus:ring-green-500 rounded border-gray-300">
                    <span class="ml-2 text-gray-700">Parkeerplaats</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="speeltuin" value="1"
                        class="text-green-600 focus:ring-green-500 rounded border-gray-300">
                    <span class="ml-2 text-gray-700">Speeltuin</span>
                </label>
            </div>
        </div>

        <!-- Zoekknop -->
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Zoeken</button>

        <!-- Prijs Section -->
        <div class="border-neutral-30 mt-6 border-b pb-6">
            <div class="font-semibold text-black mb-4">Prijs (€)</div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Min Price -->
                <div class="flex items-center">
                    <label for="min-prijs-input" class="text-sm font-medium text-gray-700 mr-2">Min:</label>
                    <input type="number" id="min-prijs-input" name="min_prijs"
                        value="{{ request()->input('min_prijs', 0) }}" min="0" max="10000"
                        class="w-1/2 mt-1 p-3 border border-gray-300 rounded-md text-lg" autocomplete="off">

                    <!-- Slider for Min Price -->
                    <input type="range" id="min_prijs" name="min_prijs_range" min="0" max="10000"
                        value="{{ request()->input('min_prijs', 0) }}" class="w-1/2 ml-4 accent-blue-500">
                </div>

                <!-- Max Price -->
                <div class="flex items-center">
                    <label for="max-prijs-input" class="text-sm font-medium text-gray-700 mr-2">Max:</label>
                    <input type="number" id="max-prijs-input" name="max_prijs"
                        value="{{ request()->input('max_prijs', 10000) }}" min="0" max="10000"
                        class="w-1/2 mt-1 p-3 border border-gray-300 rounded-md text-lg" autocomplete="off">

                    <!-- Slider for Max Price -->
                    <input type="range" id="max_prijs" name="max_prijs_range" min="0" max="10000"
                        value="{{ request()->input('max_prijs', 10000) }}" class="w-1/2 ml-4 accent-blue-500">
                </div>
            </div>
        </div>

        <!-- Location Section (Postcode, Straatnaam, Stad) -->
        <div class="border-neutral-30 mt-6 border-b pb-6">
            <div class="font-semibold text-black mb-4">Locatie</div>

            <!-- Postcode -->
            <div class="mb-4">
                <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode</label>
                <input type="text" id="postcode" name="postcode"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:border-green-500 text-lg"
                    value="{{ request()->input('postcode') }}" autocomplete="off">
            </div>

            <!-- Straatnaam -->
            <div class="mb-4">
                <label for="straatnaam" class="block text-sm font-medium text-gray-700">Straatnaam</label>
                <input type="text" id="straatnaam" name="straatnaam"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:border-green-500 text-lg"
                    value="{{ request()->input('straatnaam') }}" autocomplete="off">
            </div>

            <!-- Stad -->
            <div class="mb-4 relative">
                <label for="stad" class="block text-sm font-medium text-gray-700">Stad</label>
                <input type="text" id="stad" name="stad" placeholder="Typ een plaats"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:border-green-500 text-lg"
                    value="{{ request()->input('stad') }}" autocomplete="off">
                <div id="stad-suggestions"
                    class="absolute z-10 w-full bg-white shadow-lg border border-gray-200 mt-1 rounded-md max-h-60 overflow-y-auto hidden">
                </div>
            </div>
        </div>

        <!-- Voorzieningen Section -->
        <div class="border-neutral-30 mt-6 border-b pb-6">
            <div class="font-semibold text-black mb-4">Voorzieningen</div>
            <div class="flex flex-col space-y-2">
                <label><input type="checkbox" name="wifi" value="1"
                        {{ request()->has('wifi') ? 'checked' : '' }}> Wi-Fi</label>
                <label><input type="checkbox" name="zwembad" value="1"
                        {{ request()->has('zwembad') ? 'checked' : '' }}> Zwembad</label>
                <label><input type="checkbox" name="parkeren" value="1"
                        {{ request()->has('parkeren') ? 'checked' : '' }}> Parkeren</label>
                <label><input type="checkbox" name="speeltuin" value="1"
                        {{ request()->has('speeltuin') ? 'checked' : '' }}> Speeltuin</label>
            </div>
        </div>


    </form>
</div>
