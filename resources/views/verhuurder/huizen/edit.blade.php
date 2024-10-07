<!-- edit.blade.php -->
<x-app-layout>
    <x-header />

    <div class="flex">
        <!-- Sidebar -->
        <x-sidebar title="Huizenbeheer">
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                    Huizen</a></li>
            <li><a href="{{ route('verhuurder.huizen.create') }}" class="text-gray-700 hover:text-green-600">Voeg Huis
                    Toe</a></li>
        </x-sidebar>

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">Bewerk Vakantiehuis: {{ $vakantiehuis->naam }}</h1>




            <!-- Form for editing a vacation home -->
            <form action="{{ route('verhuurder.huizen.update', $vakantiehuis->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Naam -->
                <div class="mb-4">
                    <label for="naam" class="block text-sm font-medium text-gray-700">Naam</label>
                    <input type="text" id="naam" name="naam" value="{{ old('naam', $vakantiehuis->naam) }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Prijs -->
                <div class="mb-4">
                    <label for="prijs" class="block text-sm font-medium text-gray-700">Prijs (€)</label>
                    <input type="number" step="0.01" id="prijs" name="prijs"
                        value="{{ old('prijs', $vakantiehuis->prijs) }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Beschrijving -->
                <div class="mb-4">
                    <label for="beschrijving" class="block text-sm font-medium text-gray-700">Beschrijving</label>
                    <textarea id="beschrijving" name="beschrijving" rows="4"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md">{{ old('beschrijving', $vakantiehuis->beschrijving) }}</textarea>
                </div>

                <!-- Slaapkamers -->
                <div class="mb-4">
                    <label for="slaapkamers" class="block text-sm font-medium text-gray-700">Aantal Slaapkamers</label>
                    <input type="number" id="slaapkamers" name="slaapkamers"
                        value="{{ old('slaapkamers', $vakantiehuis->slaapkamers) }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Locatie (met auto-suggestie) -->
                <div class="mb-4">
                    <label for="location" class="block text-sm font-medium text-gray-700">Stad</label>
                    <div class="relative">
                        <input type="text" id="location" name="location"
                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            placeholder="Voer een stad of locatie in"
                            value="{{ old('location', $vakantiehuis->stad) }}">
                        <div id="location-suggestions"
                            class="absolute z-10 w-full bg-white shadow-lg border border-gray-200 mt-1 rounded-md max-h-60 overflow-y-auto hidden">
                        </div>
                    </div>
                </div>

                <!-- Straatnaam -->
                <div class="mb-4">
                    <label for="straatnaam" class="block text-sm font-medium text-gray-700">Straatnaam</label>
                    <input type="text" id="straatnaam" name="straatnaam"
                        value="{{ old('straatnaam', $vakantiehuis->straatnaam) }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Postcode -->
                <div class="mb-4">
                    <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode</label>
                    <input type="text" id="postcode" name="postcode"
                        value="{{ old('postcode', $vakantiehuis->postcode) }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Huisnummer -->
                <div class="mb-4">
                    <label for="huisnummer" class="block text-sm font-medium text-gray-700">Huisnummer</label>
                    <input type="text" id="huisnummer" name="huisnummer"
                        value="{{ old('huisnummer', $vakantiehuis->huisnummer) }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Voorzieningen -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Voorzieningen</label>
                    <div class="flex flex-wrap">
                        <label class="mr-4 mb-2"><input type="checkbox" name="wifi" value="1"
                                {{ $vakantiehuis->wifi ? 'checked' : '' }}> Wi-Fi</label>
                        <label class="mr-4 mb-2"><input type="checkbox" name="zwembad" value="1"
                                {{ $vakantiehuis->zwembad ? 'checked' : '' }}> Zwembad</label>
                        <label class="mr-4 mb-2"><input type="checkbox" name="parkeren" value="1"
                                {{ $vakantiehuis->parkeren ? 'checked' : '' }}> Parkeerplaats</label>
                        <label class="mr-4 mb-2"><input type="checkbox" name="speeltuin" value="1"
                                {{ $vakantiehuis->speeltuin ? 'checked' : '' }}> Speeltuin</label>
                    </div>
                </div>

                <!-- Beschikbaarheid -->
                <div class="mb-4">
                    <label for="beschikbaarheid"
                        class="block text-sm font-medium text-gray-700">Beschikbaarheid</label>
                    <select id="beschikbaarheid" name="beschikbaarheid"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                        <option value="1" {{ $vakantiehuis->beschikbaarheid ? 'selected' : '' }}>Ja</option>
                        <option value="0" {{ !$vakantiehuis->beschikbaarheid ? 'selected' : '' }}>Nee</option>
                    </select>
                </div>

                <!-- Foto -->
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
                    Bijwerken</button>
            </form>

            <!-- Delete Button -->
            <form action="{{ route('verhuurder.huizen.destroy', $vakantiehuis->id) }}" method="POST"
                class="mt-4">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">Verwijder
                    Vakantiehuis</button>
            </form>
        </div>
    </div>

    <x-footer />
</x-app-layout>
