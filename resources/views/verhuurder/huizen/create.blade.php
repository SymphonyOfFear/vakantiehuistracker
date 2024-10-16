<x-app-layout>
    <div class="flex lg:flex-nowrap flex-wrap min-h-screen bg-gray-100">
        <x-sidebar title="Huizenbeheer">
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                    Huizen</a></li>
            <li><a href="{{ route('verhuurder.huizen.create') }}" class="text-gray-700 hover:text-green-600">Voeg Huis
                    Toe</a></li>
        </x-sidebar>

        <div class="w-full lg:w-3/4 p-8 bg-white lg:ml-auto shadow-lg rounded-lg">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Voeg Nieuw Vakantiehuis Toe</h1>

            <div x-data="{ tab: 'general' }" class="space-y-6">
                <div class="border-b border-gray-300 mb-6">
                    <nav class="flex space-x-4">
                        <button @click="tab = 'general'"
                            :class="tab === 'general' ? 'border-green-600 text-green-600' :
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="px-4 py-3 font-medium text-lg border-b-2 focus:outline-none">Algemene Info</button>
                        <button @click="tab = 'address'"
                            :class="tab === 'address' ? 'border-green-600 text-green-600' :
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="px-4 py-3 font-medium text-lg border-b-2 focus:outline-none">Adres</button>
                        <button @click="tab = 'facilities'"
                            :class="tab === 'facilities' ? 'border-green-600 text-green-600' :
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="px-4 py-3 font-medium text-lg border-b-2 focus:outline-none">Voorzieningen</button>
                        <button @click="tab = 'images'"
                            :class="tab === 'images' ? 'border-green-600 text-green-600' :
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="px-4 py-3 font-medium text-lg border-b-2 focus:outline-none">Afbeeldingen</button>
                    </nav>
                </div>

                <form action="{{ route('verhuurder.huizen.store') }}" method="POST" enctype="multipart/form-data"
                    id="create-form">
                    @csrf

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
                    </div>

                    <div x-show="tab === 'address'" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="relative">
                                <label for="stad" class="block text-lg font-medium text-gray-700">Stad</label>
                                <input type="text" id="stad" name="stad" value="{{ old('stad') }}"
                                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-600 focus:border-green-600"
                                    required autocomplete="off">
                                <div id="stad-suggestions"
                                    class="hidden absolute bg-white border border-gray-300 rounded mt-1 w-full z-10">
                                </div>
                            </div>

                            <div class="relative">
                                <label for="postcode" class="block text-lg font-medium text-gray-700">Postcode</label>
                                <input type="text" id="postcode" name="postcode" value="{{ old('postcode') }}"
                                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-600 focus:border-green-600"
                                    required autocomplete="off">
                                <div id="postcode-suggestions"
                                    class="hidden absolute bg-white border border-gray-300 rounded mt-1 w-full z-10">
                                </div>
                            </div>

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
        </div>
    </div>
</x-app-layout>
