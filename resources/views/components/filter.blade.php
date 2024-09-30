<div class="w-full lg:w-1/4 p-4 bg-white shadow-md">
    <h2 class="text-xl font-bold mb-4">Filters</h2>

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
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Voorzieningen</label>
            <div class="flex flex-col space-y-2">
                <label><input type="checkbox" name="wifi" value="1"> Wi-Fi</label>
                <label><input type="checkbox" name="zwembad" value="1"> Zwembad</label>
                <label><input type="checkbox" name="parkeren" value="1"> Parkeerplaats</label>
                <label><input type="checkbox" name="speeltuin" value="1"> Speeltuin</label>
            </div>
        </div>

        <!-- Zoekknop -->
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Zoeken</button>
    </form>
</div>
