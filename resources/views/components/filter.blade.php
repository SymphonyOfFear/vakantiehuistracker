<div class="w-full lg:w-1/4 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">Filters</h2>
    <form action="{{ url()->current() }}" method="GET" class="space-y-4">
        <!-- Locatie Filter (Dropdown with Search) -->
        <div class="flex flex-col">
            <label for="locatie" class="text-gray-600 mb-2">Locatie</label>
            <select name="locatie" id="locatie"
                class="select-search px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
                <option value="">Selecteer een locatie</option>
                @foreach ($locations as $location)
                    <option value="{{ $location['name'] }}">{{ $location['name'] }}</option>
                @endforeach
            </select>
        </div>

        <!-- Minimale Prijs Filter -->
        <div class="flex flex-col">
            <label for="min_prijs" class="text-gray-600 mb-2">Minimale Prijs</label>
            <input type="number" name="min_prijs" id="min_prijs" value="{{ request('min_prijs') }}"
                class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500"
                placeholder="0">
        </div>

        <!-- Maximale Prijs Filter -->
        <div class="flex flex-col">
            <label for="max_prijs" class="text-gray-600 mb-2">Maximale Prijs</label>
            <input type="number" name="max_prijs" id="max_prijs" value="{{ request('max_prijs') }}"
                class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500"
                placeholder="Geen max">
        </div>

        <!-- Amenities Filter (Checkboxes) -->
        <div class="flex flex-col">
            <label class="text-gray-600 mb-2">Voorzieningen</label>
            <div class="flex items-center">
                <input type="checkbox" name="zwembad" id="zwembad" value="1"
                    {{ request('zwembad') ? 'checked' : '' }} class="mr-2">
                <label for="zwembad" class="text-gray-700">Zwembad</label>
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="wifi" id="wifi" value="1"
                    {{ request('wifi') ? 'checked' : '' }} class="mr-2">
                <label for="wifi" class="text-gray-700">Wi-Fi</label>
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="spa" id="spa" value="1"
                    {{ request('spa') ? 'checked' : '' }} class="mr-2">
                <label for="spa" class="text-gray-700">Spa</label>
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="speeltuin" id="speeltuin" value="1"
                    {{ request('speeltuin') ? 'checked' : '' }} class="mr-2">
                <label for="speeltuin" class="text-gray-700">Speeltuin</label>
            </div>
        </div>

        <div class="flex">
            <button type="submit"
                class="w-full px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                Filter
            </button>
        </div>
    </form>
</div>
