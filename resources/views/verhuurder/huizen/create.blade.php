<x-app-layout>
    <div class="flex lg:flex-nowrap flex-wrap min-h-screen">
    
        <x-sidebar title="Huizenbeheer" class="lg:min-h-screen">
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                    Huizen</a></li>
            <li><a href="{{ route('verhuurder.huizen.create') }}" class="text-gray-700 hover:text-green-600">Voeg Huis
                    Toe</a></li>
        </x-sidebar>

        <div class="w-full lg:w-3/4 p-6 bg-white lg:ml-auto">
            <h1 class="text-2xl font-bold mb-4">Voeg Nieuw Vakantiehuis Toe</h1>

            <div x-data="{ tab: 'general' }" class="space-y-6">
                <div class="border-b border-gray-200 mb-4">
                    <nav class="flex space-x-4">
                        <button @click="tab = 'general'"
                            :class="tab === 'general' ? 'border-green-600 text-green-600' :
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="px-3 py-2 font-medium text-sm border-b-2 focus:outline-none">
                            Algemene Info
                        </button>
                        <button @click="tab = 'address'"
                            :class="tab === 'address' ? 'border-green-600 text-green-600' :
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="px-3 py-2 font-medium text-sm border-b-2 focus:outline-none">
                            Adres
                        </button>
                        <button @click="tab = 'facilities'"
                            :class="tab === 'facilities' ? 'border-green-600 text-green-600' :
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="px-3 py-2 font-medium text-sm border-b-2 focus:outline-none">
                            Voorzieningen
                        </button>
                        <button @click="tab = 'images'"
                            :class="tab === 'images' ? 'border-green-600 text-green-600' :
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="px-3 py-2 font-medium text-sm border-b-2 focus:outline-none">
                            Afbeeldingen
                        </button>
                    </nav>
                </div>

                <form action="{{ route('verhuurder.huizen.store') }}" method="POST" enctype="multipart/form-data"
                    id="create-form">
                    @csrf

                    <div x-show="tab === 'general'" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="naam" class="block text-sm font-medium text-gray-700">Naam</label>
                                <input type="text" id="naam" name="naam" value="{{ old('naam') }}"
                                    class="w-full mt-1 p-2 border border-gray-300 rounded-md"
                                    x-bind:required="tab === 'general'">
                            </div>
                            <div>
                                <label for="slaapkamers"
                                    class="block text-sm font-medium text-gray-700">Slaapkamers</label>
                                <input type="number" step="0.01" id="slaapkamers" name="slaapkamers"
                                    value="{{ old('slaapkamers') }}"
                                    class="w-full mt-1 p-2 border border-gray-300 rounded-md"
                                    x-bind:required="tab === 'general'">
                            </div>
                            <div>
                                <label for="prijs" class="block text-sm font-medium text-gray-700">Prijs (€)</label>
                                <input type="number" step="0.01" id="prijs" name="prijs"
                                    value="{{ old('prijs') }}"
                                    class="w-full mt-1 p-2 border border-gray-300 rounded-md"
                                    x-bind:required="tab === 'general'">
                            </div>
                            <div>
                                <label for="beschrijving"
                                    class="block text-sm font-medium text-gray-700">Beschrijving</label>
                                <textarea id="beschrijving" name="beschrijving" rows="4"
                                    class="w-full mt-1 p-2 border border-gray-300 rounded-md">{{ old('beschrijving') }}</textarea>
                            </div>
                        </div>
                    </div>


                    <div x-show="tab === 'address'" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="relative">
                                <label for="stad" class="block text-sm font-medium text-gray-700">Stad</label>
                                <input type="text" id="stad" name="stad" value="{{ old('stad') }}"
                                    class="w-full mt-1 p-2 border border-gray-300 rounded-md"
                                    x-bind:required="tab === 'address'">
                                <div id="stad-suggestions"
                                    class="absolute hidden bg-white border border-gray-300 rounded mt-1 w-full z-10">
                                </div>
                            </div>
                            <div class="relative">
                                <label for="straatnaam"
                                    class="block text-sm font-medium text-gray-700">Straatnaam</label>
                                <input type="text" id="straatnaam" name="straatnaam" value="{{ old('straatnaam') }}"
                                    class="w-full mt-1 p-2 border border-gray-300 rounded-md"
                                    x-bind:required="tab === 'address'">
                                <div id="straatnaam-suggestions"
                                    class="absolute hidden bg-white border border-gray-300 rounded mt-1 w-full z-10">
                                </div>
                            </div>
                            <div>
                                <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode</label>
                                <input type="text" id="postcode" name="postcode" value="{{ old('postcode') }}"
                                    class="w-full mt-1 p-2 border border-gray-300 rounded-md"
                                    x-bind:required="tab === 'address'">
                            </div>
                            <div>
                                <label for="huisnummer"
                                    class="block text-sm font-medium text-gray-700">Huisnummer</label>
                                <input type="text" id="huisnummer" name="huisnummer"
                                    value="{{ old('huisnummer') }}"
                                    class="w-full mt-1 p-2 border border-gray-300 rounded-md"
                                    x-bind:required="tab === 'address'">
                            </div>
                            <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}">
                            <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}">
                        </div>
                    </div>


                    <div x-show="tab === 'facilities'" class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700">Voorzieningen</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="wifi" value="1"
                                    {{ old('wifi') ? 'checked' : '' }}>
                                <span class="ml-2">Wi-Fi</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="zwembad" value="1"
                                    {{ old('zwembad') ? 'checked' : '' }}>
                                <span class="ml-2">Zwembad</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="parkeren" value="1"
                                    {{ old('parkeren') ? 'checked' : '' }}>
                                <span class="ml-2">Parkeerplaats</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="speeltuin" value="1"
                                    {{ old('speeltuin') ? 'checked' : '' }}>
                                <span class="ml-2">Speeltuin</span>
                            </label>
                        </div>
                    </div>


                    <div x-show="tab === 'images'" class="space-y-4">
                        <label for="fotos" class="block text-sm font-medium text-gray-700">Foto's</label>
                        <input type="file" id="fotos" name="fotos[]" multiple
                            class="w-full mt-1 p-2 border border-gray-300 rounded-md" accept="image/*">
                    </div>


                    <div class="text-right">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg mt-4">
                            Vakantiehuis Aanmaken
                        </button>
                    </div>
                </form>

                <div id="map" class="w-full h-64 bg-gray-200 mt-10 rounded-lg shadow-lg"
                    data-lat="{{ old('latitude', $vakantiehuis->latitude ?? 52.3676) }}"
                    data-lon="{{ old('longitude', $vakantiehuis->longitude ?? 4.9041) }}">
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
