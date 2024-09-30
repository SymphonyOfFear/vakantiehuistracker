<x-app-layout>
    <x-header />

    <div class="min-h-screen bg-green-100 py-16">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">Bewerk Vakantiehuis</h1>

            <!-- Edit House Form -->
            <form action="{{ route('verhuurder.huizen.update', $huisje->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- House Name -->
                <div class="mb-4">
                    <label for="naam" class="block text-gray-700">Naam:</label>
                    <input type="text" name="naam" id="naam" value="{{ $huisje->naam }}"
                        class="w-full px-4 py-2 border rounded-md" required>
                </div>

                <!-- Location -->
                <div class="mb-4">
                    <label for="locatie" class="block text-gray-700">Locatie:</label>
                    <input type="text" name="locatie" id="locatie" value="{{ $huisje->locatie }}"
                        class="w-full px-4 py-2 border rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="prijs" class="block text-gray-700">Prijs:</label>
                    <input type="text" name="prijs" id="prijs" value="{{ $huisje->prijs }}"
                        class="w-full px-4 py-2 border rounded-md" required>
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label for="slaapkamers" class="block text-gray-700">Aantal slaapkamers:</label>
                    <input type="number" name="slaapkamers" id="slaapkamers" value="{{ $huisje->slaapkamers }}"
                        class="w-full px-4 py-2 border rounded-md" required>
                </div>

                <!-- Amenities (Checkboxes) -->
                <div class="mb-4">
                    <h3 class="block text-gray-700 mb-2">Voorzieningen:</h3>
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="zwembad" id="zwembad" value="1"
                            {{ $huisje->zwembad ? 'checked' : '' }} class="mr-2">
                        <label for="zwembad" class="text-gray-600">Zwembad</label>
                    </div>
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="wifi" id="wifi" value="1"
                            {{ $huisje->wifi ? 'checked' : '' }} class="mr-2">
                        <label for="wifi" class="text-gray-600">Wi-Fi</label>
                    </div>
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="spa" id="spa" value="1"
                            {{ $huisje->spa ? 'checked' : '' }} class="mr-2">
                        <label for="spa" class="text-gray-600">Spa</label>
                    </div>
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="speeltuin" id="speeltuin" value="1"
                            {{ $huisje->speeltuin ? 'checked' : '' }} class="mr-2">
                        <label for="speeltuin" class="text-gray-600">Speeltuin</label>
                    </div>
                </div>

                <!-- House Photos -->
                <div class="mb-4">
                    <label for="fotos" class="block text-gray-700">Foto's:</label>
                    <input type="file" name="fotos[]" id="fotos" multiple
                        class="w-full px-4 py-2 border rounded-md">
                </div>

                <!-- Availability -->
                <div class="mb-4">
                    <label for="beschikbaarheid" class="block text-gray-700">Beschikbaarheid:</label>
                    <select name="beschikbaarheid" id="beschikbaarheid" class="w-full px-4 py-2 border rounded-md">
                        <option value="1" {{ $huisje->beschikbaarheid ? 'selected' : '' }}>Beschikbaar</option>
                        <option value="0" {{ !$huisje->beschikbaarheid ? 'selected' : '' }}>Niet Beschikbaar</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit"
                        class="w-full px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                        Update Vakantiehuis
                    </button>
                </div>
            </form>
        </div>
    </div>

    <x-footer />
</x-app-layout>
