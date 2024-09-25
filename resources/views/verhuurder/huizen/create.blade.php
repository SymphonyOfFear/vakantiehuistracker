<x-app-layout>
    <x-header />

    <div class="flex">
        <x-sidebar title="Huizenbeheer">
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                    Huizen</a></li>
            <li><a href="{{ route('verhuurder.huizen.create') }}" class="text-gray-700 hover:text-green-600">Voeg Huis
                    Toe</a></li>
        </x-sidebar>

        <div class="w-full lg:w-3/4 p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">Voeg nieuw vakantiehuis toe</h1>
            <form action="{{ route('verhuurder.huizen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

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
                    </div>
                </div>
                <!-- Stad -->
                <div class="mb-4">
                    <label for="stad" class="block text-sm font-medium text-gray-700">Stad</label>
                    <select id="stad" name="stad" class="w-full mt-1 p-2 border border-gray-300 rounded-md"
                        required>
                        <option value="">Kies een Stad</option>
                        @foreach ($steden as $stad)
                            <option value="{{ $stad['name'] }}">{{ $stad['name'] }}</option>
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

                <!-- Meerdere Foto's Upload -->
                <div class="mb-4">
                    <label for="fotos" class="block text-sm font-medium text-gray-700">Foto's</label>
                    <input type="file" id="fotos" name="fotos[]"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" accept="image/*" multiple>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Vakantiehuis
                    Toevoegen</button>
            </form>

        </div>
    </div>

    <x-footer />
</x-app-layout>
