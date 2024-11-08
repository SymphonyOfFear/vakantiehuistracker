<div class="bg-white w-full lg:w-4/4 h-screen shadow-lg p-4 fixed lg:relative overflow-y-auto">
    <h2 class="text-xl font-bold mb-4 text-gray-800">Filters</h2>

    <form action="{{ route('huizen.index') }}" method="GET">
        <!-- Price Section -->
        <div class="border-neutral-30 mt-6 border-b pb-6">
            <div class="font-semibold text-black mb-4">Prijs (€)</div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-center">
                    <label for="min-prijs-input" class="text-sm font-medium text-gray-700 mr-2">Min:</label>
                    <input type="number" id="min-prijs-input" name="min_prijs" value="{{ request('min_prijs', 0) }}" min="0" max="10000" class="w-1/2 mt-1 p-2 border border-gray-300 rounded-md text-lg" autocomplete="off">
                </div>
                <div class="flex items-center">
                    <label for="max-prijs-input" class="text-sm font-medium text-gray-700 mr-2">Max:</label>
                    <input type="number" id="max-prijs-input" name="max_prijs" value="{{ request('max_prijs', 10000) }}" min="0" max="10000" class="w-1/2 mt-1 p-2 border border-gray-300 rounded-md text-lg" autocomplete="off">
                </div>
            </div>
        </div>

        <!-- Location Section -->
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

        <!-- Amenities Section -->
        <div class="border-neutral-30 mt-6 border-b pb-6">
            <div class="font-semibold text-black mb-4">Voorzieningen</div>
            <div class="space-y-2">
                <label><input type="checkbox" name="wifi" value="1" {{ request('wifi') ? 'checked' : '' }}> Wi-Fi</label>
                <label><input type="checkbox" name="zwembad" value="1" {{ request('zwembad') ? 'checked' : '' }}> Zwembad</label>
                <label><input type="checkbox" name="parkeren" value="1" {{ request('parkeren') ? 'checked' : '' }}> Parkeren</label>
                <label><input type="checkbox" name="speeltuin" value="1" {{ request('speeltuin') ? 'checked' : '' }}> Speeltuin</label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Pas filters toe</button>
        </div>
    </form>
</div>
