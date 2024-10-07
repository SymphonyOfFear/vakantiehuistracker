<x-app-layout>
    <x-header />

    <div class="flex">
        <!-- Sidebar Component -->
        <x-sidebar title="Huizenbeheer">
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn Huizen</a></li>
            <li><a href="{{ route('verhuurder.huizen.create') }}" class="text-gray-700 hover:text-green-600">Voeg Huis Toe</a></li>
        </x-sidebar>

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-8 bg-white rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Voeg Nieuw Vakantiehuis Toe</h1>

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-400 text-red-600 p-4 rounded-lg mb-6">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form for creating a new vacation home -->
            <form action="{{ route('verhuurder.huizen.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Naam -->
                <div>
                    <label for="naam" class="block text-sm font-medium text-gray-700">Naam</label>
                    <input type="text" id="naam" name="naam" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" placeholder="Naam van het vakantiehuis" required>
                </div>

                <!-- Prijs -->
                <div>
                    <label for="prijs" class="block text-sm font-medium text-gray-700">Prijs (€)</label>
                    <input type="number" step="0.01" id="prijs" name="prijs" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" placeholder="Prijs per nacht" required>
                </div>

                <!-- Beschrijving -->
                <div>
                    <label for="beschrijving" class="block text-sm font-medium text-gray-700">Beschrijving</label>
                    <textarea id="beschrijving" name="beschrijving" rows="4" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" placeholder="Beschrijf het vakantiehuis..."></textarea>
                </div>

                <!-- Slaapkamers -->
                <div>
                    <label for="slaapkamers" class="block text-sm font-medium text-gray-700">Aantal Slaapkamers</label>
                    <input type="number" id="slaapkamers" name="slaapkamers" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" placeholder="Aantal slaapkamers" required>
                </div>

                <!-- Stad -->
                <div>
                    <label for="stad" class="block text-sm font-medium text-gray-700">Stad</label>
                    <select id="stad" name="stad" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required>
                        <option value="">Kies een Stad</option>
                        @foreach ($locations as $location)
                            @if (is_array($location) && isset($location['name']))
                                <option value="{{ $location['name'] }}">{{ $location['name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Adresvelden (Straatnaam, Postcode, Huisnummer) -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <div>
                        <label for="straatnaam" class="block text-sm font-medium text-gray-700">Straatnaam</label>
                        <input type="text" id="straatnaam" name="straatnaam" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>
                    <div>
                        <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode</label>
                        <input type="text" id="postcode" name="postcode" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>
                    <div>
                        <label for="huisnummer" class="block text-sm font-medium text-gray-700">Huisnummer</label>
                        <input type="text" id="huisnummer" name="huisnummer" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>
                </div>

                <!-- Voorzieningen -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Voorzieningen</label>
                    <div class="flex flex-wrap mt-2">
                        <label class="mr-4 mb-2"><input type="checkbox" name="wifi" value="1" class="mr-1"> Wi-Fi</label>
                        <label class="mr-4 mb-2"><input type="checkbox" name="zwembad" value="1" class="mr-1"> Zwembad</label>
                        <label class="mr-4 mb-2"><input type="checkbox" name="parkeren" value="1" class="mr-1"> Parkeerplaats</label>
                        <label class="mr-4 mb-2"><input type="checkbox" name="speeltuin" value="1" class="mr-1"> Speeltuin</label>
                    </div>
                </div>

                <!-- Beschikbaarheid -->
                <div>
                    <label for="beschikbaarheid" class="block text-sm font-medium text-gray-700">Beschikbaarheid</label>
                    <select id="beschikbaarheid" name="beschikbaarheid" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required>
                        <option value="1">Ja</option>
                        <option value="0">Nee</option>
                    </select>
                </div>

                <!-- Foto's -->
                <div>
                    <label for="fotos" class="block text-sm font-medium text-gray-700">Foto's</label>
                    <input type="file" id="fotos" name="fotos[]" multiple class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" accept="image/*">
                    @error('fotos')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                    @error('fotos.*')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="text-right">
                    <button type="submit" class="px-6 py-2 bg-green-600 text-white font-semibold rounded-md shadow-md hover:bg-green-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-green-500">Vakantiehuis Toevoegen</button>
                </div>
            </form>
        </div>
    </div>

    <x-footer />
</x-app-layout>
