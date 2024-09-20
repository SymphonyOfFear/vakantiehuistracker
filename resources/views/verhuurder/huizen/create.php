<x-app-layout>
    <x-header />
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Voeg nieuw vakantiehuis toe</h1>
        <form action="{{ route('huizen.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Naam -->
            <div class="mb-4">
                <label for="naam" class="block text-gray-700">Naam:</label>
                <input type="text" id="naam" name="naam" class="w-full p-2 border border-gray-300 rounded">
            </div>

            <!-- Prijs -->
            <div class="mb-4">
                <label for="prijs" class="block text-gray-700">Prijs:</label>
                <input type="number" id="prijs" name="prijs" class="w-full p-2 border border-gray-300 rounded">
            </div>

            <!-- Beschrijving -->
            <div class="mb-4">
                <label for="beschrijving" class="block text-gray-700">Beschrijving:</label>
                <textarea id="beschrijving" name="beschrijving" class="w-full p-2 border border-gray-300 rounded"></textarea>
            </div>

            <!-- Locatie -->
            <div class="mb-4">
                <label for="locatie" class="block text-gray-700">Locatie:</label>
                <input type="text" id="locatie" name="locatie" class="w-full p-2 border border-gray-300 rounded">
            </div>

            <!-- Slaapkamers -->
            <div class="mb-4">
                <label for="slaapkamers" class="block text-gray-700">Slaapkamers:</label>
                <input type="number" id="slaapkamers" name="slaapkamers" class="w-full p-2 border border-gray-300 rounded">
            </div>

            <!-- Foto upload -->
            <div class="mb-4">
                <label for="foto" class="block text-gray-700">Afbeelding uploaden:</label>
                <input type="file" id="foto" name="foto" class="w-full p-2">
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Vakantiehuis toevoegen</button>
        </form>
    </div>
    <x-footer />
</x-app-layout>