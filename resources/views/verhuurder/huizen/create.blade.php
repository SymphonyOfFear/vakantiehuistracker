<x-app-layout>
    <div class="flex lg:flex-nowrap flex-wrap min-h-screen bg-gray-100">
        <x-sidebar title="Huizenbeheer">
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn Huizen</a></li>
            <li><a href="{{ route('verhuurder.huizen.create') }}" class="text-gray-700 hover:text-green-600">Voeg Huis Toe</a></li>
        </x-sidebar>

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">Voeg nieuw vakantiehuis toe</h1>

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            <!-- Form for creating a new vacation home -->
            <form action="{{ route('verhuurder.huizen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

<<<<<<< HEAD
                <!-- Naam -->
                <div class="mb-4">
                    <label for="naam" class="block text-sm font-medium text-gray-700">Naam</label>
                    <input type="text" id="naam" name="naam"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Prijs -->
                <div class="mb-4">
                    <label for="prijs" class="block text-sm font-medium text-gray-700">Prijs (€)</label>
                    <input type="number" step="0.01" id="prijs" name="prijs"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Beschrijving -->
                <div class="mb-4">
                    <label for="beschrijving" class="block text-sm font-medium text-gray-700">Beschrijving</label>
                    <textarea id="beschrijving" name="beschrijving" rows="4"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md"></textarea>
                </div>

                <!-- Slaapkamers -->
                <div class="mb-4">
                    <label for="slaapkamers" class="block text-sm font-medium text-gray-700">Aantal Slaapkamers</label>
                    <input type="number" id="slaapkamers" name="slaapkamers"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Stad -->
                <div class="mb-4">
                    <label for="stad" class="block text-sm font-medium text-gray-700">Stad</label>
                    <select id="stad" name="stad" class="w-full mt-1 p-2 border border-gray-300 rounded-md"
                        required>
                        <option value="">Kies een Stad</option>
                        @foreach ($locations as $location)
                            @if (is_array($location) && isset($location['name']))
                                <option value="{{ $location['name'] }}">{{ $location['name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Straatnaam -->
                <div class="mb-4">
                    <label for="straatnaam" class="block text-sm font-medium text-gray-700">Straatnaam</label>
                    <input type="text" id="straatnaam" name="straatnaam"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Postcode -->
                <div class="mb-4">
                    <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode</label>
                    <input type="text" id="postcode" name="postcode"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Huisnummer -->
                <div class="mb-4">
                    <label for="huisnummer" class="block text-sm font-medium text-gray-700">Huisnummer</label>
                    <input type="text" id="huisnummer" name="huisnummer"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Voorzieningen -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Voorzieningen</label>
                    <div class="flex flex-wrap">
                        <label class="mr-4 mb-2"><input type="checkbox" name="wifi" value="1"> Wi-Fi</label>
                        <label class="mr-4 mb-2"><input type="checkbox" name="zwembad" value="1"> Zwembad</label>
                        <label class="mr-4 mb-2"><input type="checkbox" name="parkeren" value="1">
                            Parkeerplaats</label>
                        <label class="mr-4 mb-2"><input type="checkbox" name="speeltuin" value="1">
                            Speeltuin</label>
=======
                    <div x-show="tab === 'general'" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="naam" class="block text-lg font-medium text-gray-700">Naam</label>
                                <input type="text" id="naam" name="naam" value="{{ old('naam') }}"
                                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-600 focus:border-green-600"
                                    required autocomplete="off">
                            </div>
                            <div>
                                <label for="slaapkamers"
                                    class="block text-lg font-medium text-gray-700">Slaapkamers</label>
                                <input type="number" step="0.01" id="slaapkamers" name="slaapkamers"
                                    value="{{ old('slaapkamers') }}"
                                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-600 focus:border-green-600"
                                    required autocomplete="off">
                            </div>
                            <div>
                                <label for="prijs" class="block text-lg font-medium text-gray-700">Prijs (€)</label>
                                <input type="number" step="0.01" id="prijs" name="prijs"
                                    value="{{ old('prijs') }}"
                                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-600 focus:border-green-600"
                                    required autocomplete="off">
                            </div>
                            <div class="col-span-2">
                                <label for="beschrijving"
                                    class="block text-lg font-medium text-gray-700">Beschrijving</label>
                                <textarea id="beschrijving" name="beschrijving" rows="4"
                                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-600 focus:border-green-600"
                                    placeholder="Beschrijf het vakantiehuis..." style="resize: none;" autocomplete="off">{{ old('beschrijving') }}</textarea>
                            </div>
                        </div>
>>>>>>> mikey-backend-backup
                    </div>
                </div>

                <!-- Beschikbaarheid -->
                <div class="mb-4">
                    <label for="beschikbaarheid" class="block text-sm font-medium text-gray-700">Beschikbaarheid</label>
                    <select id="beschikbaarheid" name="beschikbaarheid"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                        <option value="1">Ja</option>
                        <option value="0">Nee</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="fotos" class="block text-sm font-medium text-gray-700">Foto's</label>
                    <input type="file" id="fotos" name="fotos[]" multiple
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" accept="image/*">
                    @error('fotos')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                    @error('fotos.*')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

<<<<<<< HEAD
                <!-- Submit Button -->
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Vakantiehuis
                    Toevoegen</button>
            </form>
=======
                            <div class="relative">
                                <label for="straatnaam"
                                    class="block text-lg font-medium text-gray-700">Straatnaam</label>
                                <input type="text" id="straatnaam" name="straatnaam" value="{{ old('straatnaam') }}"
                                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-600 focus:border-green-600"
                                    required autocomplete="off">
                                <div id="straatnaam-suggestions"
                                    class="hidden absolute bg-white border border-gray-300 rounded mt-1 w-full z-10">
                                </div>
                            </div>

                            <div>
                                <label for="huisnummer"
                                    class="block text-lg font-medium text-gray-700">Huisnummer</label>
                                <input type="text" id="huisnummer" name="huisnummer"
                                    value="{{ old('huisnummer') }}"
                                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-600 focus:border-green-600"
                                    required autocomplete="off">
                            </div>
                            <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}">
                            <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}">
                        </div>
                    </div>

                    <div x-show="tab === 'facilities'" class="space-y-4">
                        <label class="block text-lg font-medium text-gray-700">Voorzieningen</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            <label class="flex items-center"><input type="checkbox" name="wifi"
                                    value="1"><span class="ml-2">Wi-Fi</span></label>
                            <label class="flex items-center"><input type="checkbox" name="zwembad"
                                    value="1"><span class="ml-2">Zwembad</span></label>
                            <label class="flex items-center"><input type="checkbox" name="parkeren"
                                    value="1"><span class="ml-2">Parkeerplaats</span></label>
                            <label class="flex items-center"><input type="checkbox" name="speeltuin"
                                    value="1"><span class="ml-2">Speeltuin</span></label>
                        </div>
                    </div>

                    <div x-show="tab === 'images'" class="space-y-4">
                        <label for="fotos" class="block text-lg font-medium text-gray-700">Nieuwe Foto's</label>
                        <input type="file" id="fotos" name="fotos[]" multiple
                            class="w-full mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-600 focus:border-green-600"
                            accept="image/*" onchange="previewNewImages(event)">
                        <div id="new-image-previews" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6"></div>
                    </div>

                    <div class="text-right mt-6">
                        <button type="submit"
                            class="bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-green-700 transition">Vakantiehuis
                            Aanmaken</button>
                    </div>
                </form>

                <div id="map" class="w-full h-64 bg-gray-200 mt-10 rounded-lg shadow-lg"></div>
            </div>
>>>>>>> mikey-backend-backup
        </div>
    </div>
</x-app-layout>
