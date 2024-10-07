<x-app-layout>
    <x-header />

    <div class="min-h-screen bg-gray-50 py-16">
        <div class="container mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-4xl font-semibold text-gray-800 mb-8 text-center">Voeg Nieuw Vakantiehuis Toe</h1>

            <!-- Add House Form -->
            <form action="{{ route('verhuurder.huizen.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- House Name -->
                <div>
                    <label for="naam" class="block text-lg font-medium text-gray-700">Naam</label>
                    <input type="text" name="naam" id="naam" class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" placeholder="Naam van het vakantiehuis" required>
                </div>

                <!-- Location -->
                <div>
                    <label for="locatie" class="block text-lg font-medium text-gray-700">Locatie</label>
                    <input type="text" name="locatie" id="locatie" class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" placeholder="Bijvoorbeeld: Amsterdam" required>
                </div>

                <!-- Prijs -->
                <div>
                    <label for="prijs" class="block text-lg font-medium text-gray-700">Prijs (€)</label>
                    <input type="number" name="prijs" id="prijs" class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" placeholder="Bijvoorbeeld: 100" required>
                </div>

                <!-- Aantal slaapkamers -->
                <div>
                    <label for="slaapkamers" class="block text-lg font-medium text-gray-700">Aantal Slaapkamers</label>
                    <input type="number" name="slaapkamers" id="slaapkamers" class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" placeholder="Bijvoorbeeld: 2" required>
                </div>

                <!-- Voorzieningen (Checkboxes) -->
                <div>
                    <h3 class="text-lg font-medium text-gray-700 mb-2">Voorzieningen</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="zwembad" id="zwembad" value="1" class="h-5 w-5 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                            <label for="zwembad" class="ml-3 text-gray-600">Zwembad</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="wifi" id="wifi" value="1" class="h-5 w-5 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                            <label for="wifi" class="ml-3 text-gray-600">Wi-Fi</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="spa" id="spa" value="1" class="h-5 w-5 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                            <label for="spa" class="ml-3 text-gray-600">Spa</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="speeltuin" id="speeltuin" value="1" class="h-5 w-5 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                            <label for="speeltuin" class="ml-3 text-gray-600">Speeltuin</label>
                        </div>
                    </div>
                </div>

                <!-- House Photos -->
                <div>
                    <label for="fotos" class="block text-lg font-medium text-gray-700">Foto's</label>
                    <input type="file" name="fotos[]" id="fotos" multiple class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
                    <p class="text-sm text-gray-500 mt-2">Upload meerdere afbeeldingen om het vakantiehuis goed te presenteren.</p>
                </div>

                <!-- Beschikbaarheid -->
                <div>
                    <label for="beschikbaarheid" class="block text-lg font-medium text-gray-700">Beschikbaarheid</label>
                    <select name="beschikbaarheid" id="beschikbaarheid" class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
                        <option value="1">Beschikbaar</option>
                        <option value="0">Niet Beschikbaar</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-green-500">Voeg Vakantiehuis Toe</button>
                </div>
            </form>
        </div>
    </div>

    <x-footer />
</x-app-layout>
