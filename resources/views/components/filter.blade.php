<div class="w-full bg-white p-4 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4 text-gray-800">Filters</h2>

    <form action="{{ route('huizen.index') }}" method="GET">

        <!-- Stad Field with Autocomplete -->
        <div class="mb-4 relative">
            <label for="stad" class="block text-sm font-medium text-gray-700">Stad</label>
            <input type="text" id="stad" name="stad" placeholder="Typ een plaats, buurt of postcode"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500"
                autocomplete="off">
            <div id="stad-suggestions"
                class="absolute z-10 w-full bg-white shadow-lg border border-gray-200 mt-1 rounded-md max-h-60 overflow-y-auto hidden">
            </div>
        </div>

        <!-- Postcode Field -->
        <div class="mb-4">
            <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode</label>
            <input type="text" id="postcode" name="postcode"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500"
                autocomplete="off">
            <div id="postcode-suggestions"
                class="absolute z-10 w-full bg-white shadow-lg border border-gray-200 mt-1 rounded-md max-h-60 overflow-y-auto hidden">
            </div>
        </div>

        <!-- Straatnaam Field with Auto-fill -->
        <div class="mb-4">
            <label for="straatnaam" class="block text-sm font-medium text-gray-700">Straatnaam</label>
            <input type="text" id="straatnaam" name="straatnaam"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500"
                autocomplete="off">
            <div id="straatnaam-suggestions"
                class="absolute z-10 w-full bg-white shadow-lg border border-gray-200 mt-1 rounded-md max-h-60 overflow-y-auto hidden">
            </div>
        </div>

        <!-- Huisnummer Field -->
        <div class="mb-4">
            <label for="huisnummer" class="block text-sm font-medium text-gray-700">Huisnummer</label>
            <input type="text" id="huisnummer" name="huisnummer"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500"
                autocomplete="off">
        </div>

        <!-- Prijs Range Slider -->
        <div class="mb-4">
            <label for="prijs" class="block text-sm font-medium text-gray-700">Prijsbereik (€)</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-center">
                    <label for="min-prijs-input" class="text-sm font-medium text-gray-700 mr-2">Min:</label>
                    <input type="number" id="min-prijs-input" name="min_prijs" value="0" min="0"
                        max="1000" class="w-full mt-1 p-2 border border-gray-300 rounded-md" autocomplete="off">
                </div>
                <div class="flex items-center">
                    <label for="max-prijs-input" class="text-sm font-medium text-gray-700 mr-2">Max:</label>
                    <input type="number" id="max-prijs-input" name="max_prijs" value="1000" min="0"
                        max="1000" class="w-full mt-1 p-2 border border-gray-300 rounded-md" autocomplete="off">
                </div>
            </div>

            <div class="mt-4">
                <input type="range" id="min_prijs" name="min_prijs_range" min="0" max="1000" value="0"
                    class="w-full">
                <input type="range" id="max_prijs" name="max_prijs_range" min="0" max="1000" value="1000"
                    class="w-full">
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

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
            Zoeken
        </button>
    </form>
</div>
