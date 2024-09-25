<div class="bg-white p-4 rounded-lg shadow mb-4">
    <form action="{{ route('huizen.index') }}" method="GET" class="space-y-4">

        <!-- Stad Filter -->
        <div>
            <label for="stad" class="block text-sm font-medium text-gray-700">Stad</label>
            <select id="stad" name="stad" class="select-search w-full mt-1 p-2 border border-gray-300 rounded-md">
                <option value="">Selecteer een stad</option>
                @foreach ($locations as $locatie)
                    @if (is_array($locatie) && isset($locatie['name']))
                        <option value="{{ $locatie['name'] }}">{{ $locatie['name'] }}</option>
                    @else
                        <option value="{{ $locatie }}">{{ $locatie }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <!-- Postcode -->
        <div>
            <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode</label>
            <input type="text" id="postcode" name="postcode" placeholder="Vul een postcode in"
                class="w-full p-2 border border-gray-300 rounded-md">
        </div>

        <!-- Straatnaam -->
        <div>
            <label for="straatnaam" class="block text-sm font-medium text-gray-700">Straatnaam</label>
            <input type="text" id="straatnaam" name="straatnaam" placeholder="Vul een straatnaam in"
                class="w-full p-2 border border-gray-300 rounded-md">
        </div>

        <!-- Huisnummer -->
        <div>
            <label for="huisnummer" class="block text-sm font-medium text-gray-700">Huisnummer</label>
            <input type="text" id="huisnummer" name="huisnummer" placeholder="Vul een huisnummer in"
                class="w-full p-2 border border-gray-300 rounded-md">
        </div>

        <!-- Prijs -->
        <div>
            <label for="max_prijs" class="block text-sm font-medium text-gray-700">Maximale Prijs (€)</label>
            <input type="number" id="max_prijs" name="max_prijs" placeholder="Vul een maximale prijs in"
                class="w-full p-2 border border-gray-300 rounded-md">
        </div>

        <!-- Slaapkamers -->
        <div>
            <label for="min_slaapkamers" class="block text-sm font-medium text-gray-700">Min. Slaapkamers</label>
            <input type="number" id="min_slaapkamers" name="min_slaapkamers" placeholder="Minimaal aantal slaapkamers"
                class="w-full p-2 border border-gray-300 rounded-md">
        </div>

        <!-- Radius Filter -->
        <div>
            <label for="radius" class="block text-sm font-medium text-gray-700">Radius (km)</label>
            <input type="number" id="radius" name="radius" placeholder="Radius (km)"
                class="w-full p-2 border border-gray-300 rounded-md">
        </div>

        <!-- Zoekknop -->
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg w-full">Filteren</button>
    </form>
</div>
