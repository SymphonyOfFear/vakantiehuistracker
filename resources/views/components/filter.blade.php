<div class="w-full lg:w-1/4 p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Filters</h2>

    <form action="{{ route('huizen.index') }}" method="GET">
        <!-- Stad -->
        <div class="mb-5">
            <label for="stad" class="block text-sm font-medium text-gray-600">Stad</label>
            <select id="stad" name="stad" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:border-green-500 focus:ring focus:ring-green-200 focus:outline-none">
                <option value="">Selecteer een stad</option>
                @foreach ($locationsList as $locatie)
                    <option value="{{ $locatie }}">{{ $locatie }}</option>
                @endforeach
            </select>
        </div>

        <!-- Radius -->
        <div class="mb-5">
            <label for="radius" class="block text-sm font-medium text-gray-600">Radius (km)</label>
            <select id="radius" name="radius" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:border-green-500 focus:ring focus:ring-green-200 focus:outline-none">
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
        <div class="mb-5">
            <label for="postcode" class="block text-sm font-medium text-gray-600">Postcode</label>
            <input type="text" id="postcode" name="postcode" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:border-green-500 focus:ring focus:ring-green-200 focus:outline-none" placeholder="Bijv. 1234AB">
        </div>

        <!-- Straatnaam -->
        <div class="mb-5">
            <label for="straatnaam" class="block text-sm font-medium text-gray-600">Straatnaam</label>
            <input type="text" id="straatnaam" name="straatnaam" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:border-green-500 focus:ring focus:ring-green-200 focus:outline-none" placeholder="Bijv. Hoofdstraat">
        </div>

        <!-- Huisnummer -->
        <div class="mb-5">
            <label for="huisnummer" class="block text-sm font-medium text-gray-600">Huisnummer</label>
            <input type="text" id="huisnummer" name="huisnummer" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:border-green-500 focus:ring focus:ring-green-200 focus:outline-none" placeholder="Bijv. 12">
        </div>

        <!-- Prijsbereik Slider -->
        <div class="mb-6">
            <label for="prijs" class="block text-sm font-medium text-gray-600">Prijsbereik (€)</label>
            <div class="flex items-center space-x-3 mt-2">
                <span id="min-prijs-label" class="text-gray-600">€0</span>
                <input type="range" id="min_prijs" name="min_prijs" min="0" max="1000" value="0" class="w-full h-2 rounded-lg bg-gray-200 focus:outline-none focus:ring-2 focus:ring-green-300" oninput="updatePrijsLabels()">
                <span id="max-prijs-label" class="text-gray-600">€1000</span>
                <input type="range" id="max_prijs" name="max_prijs" min="0" max="1000" value="1000" class="w-full h-2 rounded-lg bg-gray-200 focus:outline-none focus:ring-2 focus:ring-green-300" oninput="updatePrijsLabels()">
            </div>
        </div>

        <!-- Voorzieningen -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-600">Voorzieningen</label>
            <div class="flex flex-col space-y-3 mt-2">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="wifi" value="1" class="text-green-600 focus:ring-green-500 rounded border-gray-300">
                    <span class="ml-2 text-gray-700">Wi-Fi</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="zwembad" value="1" class="text-green-600 focus:ring-green-500 rounded border-gray-300">
                    <span class="ml-2 text-gray-700">Zwembad</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="parkeren" value="1" class="text-green-600 focus:ring-green-500 rounded border-gray-300">
                    <span class="ml-2 text-gray-700">Parkeerplaats</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="speeltuin" value="1" class="text-green-600 focus:ring-green-500 rounded border-gray-300">
                    <span class="ml-2 text-gray-700">Speeltuin</span>
                </label>
            </div>
        </div>

        <!-- Zoekknop -->
        <button type="submit" class="w-full bg-green-600 text-white px-6 py-3 rounded-lg font-semibold text-lg hover:bg-green-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-green-500">Zoeken</button>
    </form>
</div>

<script>
    function updatePrijsLabels() {
        const minPrijs = document.getElementById('min_prijs').value;
        const maxPrijs = document.getElementById('max_prijs').value;
        document.getElementById('min-prijs-label').textContent = `€${minPrijs}`;
        document.getElementById('max-prijs-label').textContent = `€${maxPrijs}`;
    }
</script>
