<x-app-layout>
    <x-header />

    <div class="flex">
        <!-- Sidebar Component with Toggle Button -->
        <div id="sidebar" class="bg-gray-100 w-64 h-screen shadow-lg p-4">
            <div class="text-lg font-semibold text-gray-800 mb-4 flex justify-between">
                <span>Menu</span>
                <button id="toggleSidebarButton" class="text-red-500">✖</button>
            </div>
            <ul class="space-y-4">
                <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                        Huizen</a></li>
                <li><a href="{{ route('verhuurder.huizen.create') }}"
                        class="text-gray-700 hover:text-green-600">Vakantiehuis Toevoegen</a></li>
                <li><a href="{{ route('reserveringen.index') }}"
                        class="text-gray-700 hover:text-green-600">Reserveringen</a></li>
            </ul>
        </div>

        <!-- Show Sidebar Button -->
        <button id="showSidebarButton"
            class="bg-green-500 text-white px-4 py-2 rounded fixed top-4 left-4 hidden">☰</button>

        <!-- Main Content -->
        <div class="w-full p-6 bg-white">
            <h1 class="text-2xl font-bold">Vakantiehuis Bewerken</h1>

            <form action="{{ route('verhuurder.huizen.update', $vakantiehuis->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Naam -->
                <div class="mb-4">
                    <label for="naam" class="block text-gray-700">Naam:</label>
                    <input type="text" id="naam" name="naam" value="{{ $vakantiehuis->naam }}"
                        class="w-full p-2 border border-gray-300 rounded">
                </div>

                <!-- Prijs -->
                <div class="mb-4">
                    <label for="prijs" class="block text-gray-700">Prijs:</label>
                    <input type="number" id="prijs" name="prijs" value="{{ $vakantiehuis->prijs }}"
                        class="w-full p-2 border border-gray-300 rounded">
                </div>

                <!-- Beschrijving -->
                <div class="mb-4">
                    <label for="beschrijving" class="block text-gray-700">Beschrijving:</label>
                    <textarea id="beschrijving" name="beschrijving" class="w-full p-2 border border-gray-300 rounded">{{ $vakantiehuis->beschrijving }}</textarea>
                </div>

                <!-- Locatie -->
                <div class="mb-4">
                    <label for="locatie" class="block text-gray-700">Locatie:</label>
                    <input type="text" id="locatie" name="locatie" value="{{ $vakantiehuis->locatie }}"
                        class="w-full p-2 border border-gray-300 rounded">
                </div>

                <!-- Slaapkamers -->
                <div class="mb-4">
                    <label for="slaapkamers" class="block text-gray-700">Slaapkamers:</label>
                    <input type="number" id="slaapkamers" name="slaapkamers" value="{{ $vakantiehuis->slaapkamers }}"
                        class="w-full p-2 border border-gray-300 rounded">
                </div>

                <!-- Foto upload -->
                <div class="mb-4">
                    <label for="foto" class="block text-gray-700">Afbeelding uploaden:</label>
                    <input type="file" id="foto" name="foto" class="w-full p-2">
                </div>

                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Vakantiehuis Bijwerken</button>
            </form>
        </div>
    </div>

    <x-footer />
</x-app-layout>
