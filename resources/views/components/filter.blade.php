<div class="w-full bg-white p-4 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4 text-gray-800">Filters</h2>

    <form action="{{ route('huizen.index') }}" method="GET">


        <div class="border-neutral-30 mt-6 border-b pb-6">
            <div class="font-semibold text-black mb-4">Prijs (€)</div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div class="flex items-center">
                    <label for="min-prijs-input" class="text-sm font-medium text-gray-700 mr-2">Min:</label>
                    <input type="number" id="min-prijs-input" name="min_prijs"
                        value="{{ request()->input('min_prijs', 0) }}" min="0" max="10000"
                        class="w-1/2 mt-1 p-2 border border-gray-300 rounded-md text-lg" autocomplete="off">


                    <input type="range" id="min_prijs" name="min_prijs_range" min="0" max="10000"
                        value="{{ request()->input('min_prijs', 0) }}" class="w-1/2 ml-4 accent-blue-500">
                </div>

                <div class="flex items-center">
                    <label for="max-prijs-input" class="text-sm font-medium text-gray-700 mr-2">Max:</label>
                    <input type="number" id="max-prijs-input" name="max_prijs"
                        value="{{ request()->input('max_prijs', 10000) }}" min="0" max="10000"
                        class="w-1/2 mt-1 p-2 border border-gray-300 rounded-md text-lg" autocomplete="off">


                    <input type="range" id="max_prijs" name="max_prijs_range" min="0" max="10000"
                        value="{{ request()->input('max_prijs', 10000) }}" class="w-1/2 ml-4 accent-blue-500">
                </div>
            </div>
        </div>


        <div class="border-neutral-30 mt-6 border-b pb-6">
            <div class="font-semibold text-black mb-4">Locatie</div>


            <div class="mb-4">
                <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode</label>
                <input type="text" id="postcode" name="postcode"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:border-green-500 text-lg"
                    value="{{ request()->input('postcode') }}" autocomplete="off">
            </div>


            <div class="mb-4">
                <label for="straatnaam" class="block text-sm font-medium text-gray-700">Straatnaam</label>
                <input type="text" id="straatnaam" name="straatnaam"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:border-green-500 text-lg"
                    value="{{ request()->input('straatnaam') }}" autocomplete="off">
            </div>


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
