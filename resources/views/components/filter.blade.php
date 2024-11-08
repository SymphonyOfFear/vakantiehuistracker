<div class="bg-white w-full lg:w-4/4 h-screen shadow-lg p-6 fixed lg:relative overflow-y-auto">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Filters en Zoekopdracht</h2>

    <form action="{{ route('huizen.index') }}" method="GET" class="space-y-8">
        <!-- Search Bar -->
        <div class="flex items-center mb-6">
            <input type="text" name="zoekopdracht" placeholder="Zoek op plaats, buurt of postcode" value="{{ request('zoekopdracht') }}" class="w-full p-3 border border-gray-300 rounded-l-md text-lg focus:outline-none focus:border-green-500" autocomplete="off">
            <button type="submit" class="bg-green-600 text-white px-4 py-3 rounded-r-md hover:bg-green-700 transition font-semibold text-lg">Zoek</button>
        </div>

        <!-- Price Section -->
        <div>
            <div class="font-semibold text-lg text-gray-800 mb-4">Prijs (€)</div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex flex-col">
                    <label for="min-prijs-input" class="text-sm font-medium text-gray-700 mb-1">Min:</label>
                    <input type="number" id="min-prijs-input" name="min_prijs" value="{{ request('min_prijs', 0) }}" min="0" max="10000" class="p-3 border border-gray-300 rounded-md text-lg focus:outline-none focus:border-green-500" autocomplete="off">
                </div>
                <div class="flex flex-col">
                    <label for="max-prijs-input" class="text-sm font-medium text-gray-700 mb-1">Max:</label>
                    <input type="number" id="max-prijs-input" name="max_prijs" value="{{ request('max_prijs', 10000) }}" min="0" max="10000" class="p-3 border border-gray-300 rounded-md text-lg focus:outline-none focus:border-green-500" autocomplete="off">
                </div>
            </div>
        </div>

        <!-- Location Section -->
        <div>
            <div class="font-semibold text-lg text-gray-800 mb-4">Locatie</div>
            <div class="mb-4">
                <label for="postcode" class="block text-sm font-medium text-gray-700 mb-1">Postcode</label>
                <input type="text" id="postcode" name="postcode" value="{{ request('postcode') }}" class="w-full p-3 border border-gray-300 rounded-md text-lg focus:outline-none focus:border-green-500" autocomplete="off">
            </div>
            <div class="mb-4">
                <label for="straatnaam" class="block text-sm font-medium text-gray-700 mb-1">Straatnaam</label>
                <input type="text" id="straatnaam" name="straatnaam" value="{{ request('straatnaam') }}" class="w-full p-3 border border-gray-300 rounded-md text-lg focus:outline-none focus:border-green-500" autocomplete="off">
            </div>
            <div class="relative">
                <label for="stad" class="block text-sm font-medium text-gray-700 mb-1">Stad</label>
                <input type="text" id="stad" name="stad" value="{{ request('stad') }}" placeholder="Typ een plaats" class="w-full p-3 border border-gray-300 rounded-md text-lg focus:outline-none focus:border-green-500" autocomplete="off">
                <div id="stad-suggestions" class="absolute z-10 w-full bg-white shadow-lg border border-gray-200 mt-1 rounded-md max-h-60 overflow-y-auto hidden"></div>
            </div>
        </div>

        <!-- Amenities Section -->
        <div>
            <div class="font-semibold text-lg text-gray-800 mb-4">Voorzieningen</div>
            <div class="grid grid-cols-2 gap-4">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="wifi" value="1" {{ request('wifi') ? 'checked' : '' }} class="rounded text-green-600">
                    <span class="text-gray-700">Wi-Fi</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="zwembad" value="1" {{ request('zwembad') ? 'checked' : '' }} class="rounded text-green-600">
                    <span class="text-gray-700">Zwembad</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="parkeren" value="1" {{ request('parkeren') ? 'checked' : '' }} class="rounded text-green-600">
                    <span class="text-gray-700">Parkeren</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="speeltuin" value="1" {{ request('speeltuin') ? 'checked' : '' }} class="rounded text-green-600">
                    <span class="text-gray-700">Speeltuin</span>
                </label>
            </div>
        </div>

        <!-- Apply Filters and Search Button -->
        <div>
            <button type="submit" class="w-full bg-green-600 text-white px-4 py-3 rounded-lg hover:bg-green-700 transition font-semibold text-lg">
             Filteren
            </button>
        </div>
    </form>
</div>
