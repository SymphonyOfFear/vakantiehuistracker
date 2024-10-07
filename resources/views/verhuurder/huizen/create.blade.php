<x-app-layout>
    <x-header />

    <div class="flex">
        <!-- Sidebar Component -->
        <x-sidebar title="Huizenbeheer">
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                    Huizen</a></li>
            <li><a href="{{ route('verhuurder.huizen.create') }}" class="text-gray-700 hover:text-green-600">Voeg Huis
                    Toe</a></li>
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
            @endif

            <!-- Form for creating a new vacation home -->
            <form action="{{ route('verhuurder.huizen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Naam -->
                <div class="mb-4">
                    <label for="naam" class="block text-sm font-medium text-gray-700">Naam</label>
                    <input type="text" id="naam" name="naam"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" value="{{ old('naam') }}" required>
                </div>

                <!-- Prijs -->
                <div class="mb-4">
                    <label for="prijs" class="block text-sm font-medium text-gray-700">Prijs (€)</label>
                    <input type="number" step="0.01" id="prijs" name="prijs"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" value="{{ old('prijs') }}" required>
                </div>

                <!-- Beschrijving -->
                <div class="mb-4">
                    <label for="beschrijving" class="block text-sm font-medium text-gray-700">Beschrijving</label>
                    <textarea id="beschrijving" name="beschrijving" rows="4"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md">{{ old('beschrijving') }}</textarea>
                </div>

                <!-- Slaapkamers -->
                <div class="mb-4">
                    <label for="slaapkamers" class="block text-sm font-medium text-gray-700">Aantal Slaapkamers</label>
                    <input type="number" id="slaapkamers" name="slaapkamers"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" value="{{ old('slaapkamers') }}"
                        required>
                </div>

                <!-- Stad met Suggestie -->
                <div class="mb-4 relative">
                    <label for="stad" class="block text-sm font-medium text-gray-700">Stad</label>
                    <input type="text" id="stad" name="stad"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500"
                        placeholder="Typ een stad in Nederland" value="{{ old('stad') }}">
                    <!-- Suggestiebox voor steden -->
                    <div id="stad-suggestions"
                        class="absolute z-10 w-full bg-white shadow-lg border border-gray-200 mt-1 rounded-md max-h-60 overflow-y-auto hidden">
                    </div>
                </div>

                <!-- Straatnaam -->
                <div class="mb-4">
                    <label for="straatnaam" class="block text-sm font-medium text-gray-700">Straatnaam</label>
                    <input type="text" id="straatnaam" name="straatnaam"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" value="{{ old('straatnaam') }}"
                        required>
                </div>

                <!-- Postcode -->
                <div class="mb-4">
                    <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode</label>
                    <input type="text" id="postcode" name="postcode"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" value="{{ old('postcode') }}"
                        required>
                </div>

                <!-- Huisnummer -->
                <div class="mb-4">
                    <label for="huisnummer" class="block text-sm font-medium text-gray-700">Huisnummer</label>
                    <input type="text" id="huisnummer" name="huisnummer"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" value="{{ old('huisnummer') }}"
                        required>
                </div>

                <!-- Voorzieningen -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Voorzieningen</label>
                    <div class="flex flex-wrap">
                        <label class="mr-4 mb-2"><input type="checkbox" name="wifi" value="1"
                                {{ old('wifi') ? 'checked' : '' }}> Wi-Fi</label>
                        <label class="mr-4 mb-2"><input type="checkbox" name="zwembad" value="1"
                                {{ old('zwembad') ? 'checked' : '' }}> Zwembad</label>
                        <label class="mr-4 mb-2"><input type="checkbox" name="parkeren" value="1"
                                {{ old('parkeren') ? 'checked' : '' }}> Parkeerplaats</label>
                        <label class="mr-4 mb-2"><input type="checkbox" name="speeltuin" value="1"
                                {{ old('speeltuin') ? 'checked' : '' }}> Speeltuin</label>
                    </div>
                </div>

                <!-- Beschikbaarheid -->
                <div class="mb-4">
                    <label for="beschikbaarheid"
                        class="block text-sm font-medium text-gray-700">Beschikbaarheid</label>
                    <select id="beschikbaarheid" name="beschikbaarheid"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                        <option value="1" {{ old('beschikbaarheid') == 1 ? 'selected' : '' }}>Ja</option>
                        <option value="0" {{ old('beschikbaarheid') == 0 ? 'selected' : '' }}>Nee</option>
                    </select>
                </div>

                <!-- Foto's -->
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

                <!-- Submit Button -->
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Vakantiehuis
                    Toevoegen</button>
            </form>
        </div>
    </div>

    <x-footer />
</x-app-layout>
