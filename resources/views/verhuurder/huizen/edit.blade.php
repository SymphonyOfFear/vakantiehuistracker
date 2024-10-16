<x-app-layout>
    <div class="flex lg:flex-nowrap flex-wrap min-h-screen">
        <x-sidebar title="Huizenbeheer" class="lg:min-h-screen">
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                    Huizen</a></li>
            <li><a href="{{ route('verhuurder.huizen.create') }}" class="text-gray-700 hover:text-green-600">Voeg Huis
                    Toe</a></li>
        </x-sidebar>

        <div class="w-full lg:w-3/4 p-6 bg-white lg:ml-auto">
            <h1 class="text-2xl font-bold mb-4">Bewerk Vakantiehuis: {{ $vakantiehuis->naam }}</h1>

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

                <form action="{{ route('verhuurder.huizen.update', $vakantiehuis->id) }}" method="POST"
                    enctype="multipart/form-data" id="edit-form">
                    @csrf
                    @method('PUT')

                    <div x-show="tab === 'general'" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="naam" class="block text-sm font-medium text-gray-700">Naam</label>
                                <input type="text" id="naam" name="naam"
                                    value="{{ old('naam', $vakantiehuis->naam) }}"
                                    class="w-full mt-1 p-2 border border-gray-300 rounded-md"
                                    x-bind:required="tab === 'general'">
                            </div>
                            <div>
                                <label for="prijs" class="block text-sm font-medium text-gray-700">Prijs (€)</label>
                                <input type="number" step="0.01" id="prijs" name="prijs"
                                    value="{{ old('prijs', $vakantiehuis->prijs) }}"
                                    class="w-full mt-1 p-2 border border-gray-300 rounded-md"
                                    x-bind:required="tab === 'general'">
                            </div>
                            <div>
                                <label for="beschrijving"
                                    class="block text-sm font-medium text-gray-700">Beschrijving</label>
                                <textarea id="beschrijving" name="beschrijving" rows="4"
                                    class="w-full mt-1 p-2 border border-gray-300 rounded-md">{{ old('beschrijving', $vakantiehuis->beschrijving) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div x-show="tab === 'address'" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="stad" class="block text-sm font-medium text-gray-700">Stad</label>
                                <input type="text" id="stad" name="stad"
                                    value="{{ old('stad', $vakantiehuis->stad) }}"
                                    class="w-full mt-1 p-2 border border-gray-300 rounded-md"
                                    x-bind:required="tab === 'address'">
                            </div>
                            <div>
                                <label for="straatnaam"
                                    class="block text-sm font-medium text-gray-700">Straatnaam</label>
                                <input type="text" id="straatnaam" name="straatnaam"
                                    value="{{ old('straatnaam', $vakantiehuis->straatnaam) }}"
                                    class="w-full mt-1 p-2 border border-gray-300 rounded-md"
                                    x-bind:required="tab === 'address'">
                            </div>
                            <div>
                                <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode</label>
                                <input type="text" id="postcode" name="postcode"
                                    value="{{ old('postcode', $vakantiehuis->postcode) }}"
                                    class="w-full mt-1 p-2 border border-gray-300 rounded-md"
                                    x-bind:required="tab === 'address'">
                            </div>
                            <div>
                                <label for="huisnummer"
                                    class="block text-sm font-medium text-gray-700">Huisnummer</label>
                                <input type="text" id="huisnummer" name="huisnummer"
                                    value="{{ old('huisnummer', $vakantiehuis->huisnummer) }}"
                                    class="w-full mt-1 p-2 border border-gray-300 rounded-md"
                                    x-bind:required="tab === 'address'">
                            </div>
                            <input type="hidden" id="latitude" name="latitude"
                                value="{{ old('latitude', $vakantiehuis->latitude) }}">
                            <input type="hidden" id="longitude" name="longitude"
                                value="{{ old('longitude', $vakantiehuis->longitude) }}">
                        </div>
                    </div>

                    <div x-show="tab === 'facilities'" class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700">Voorzieningen</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="wifi" value="1"
                                    {{ isset($vakantiehuis) && $vakantiehuis->wifi ? 'checked' : '' }}>
                                <span class="ml-2">Wi-Fi</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="zwembad" value="1"
                                    {{ isset($vakantiehuis) && $vakantiehuis->zwembad ? 'checked' : '' }}>
                                <span class="ml-2">Zwembad</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="parkeren" value="1"
                                    {{ isset($vakantiehuis) && $vakantiehuis->parkeren ? 'checked' : '' }}>
                                <span class="ml-2">Parkeerplaats</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="speeltuin" value="1"
                                    {{ isset($vakantiehuis) && $vakantiehuis->speeltuin ? 'checked' : '' }}>
                                <span class="ml-2">Speeltuin</span>
                            </label>
                        </div>
                    </div>

                    <div x-show="tab === 'images'" class="space-y-4">
                        @if (isset($vakantiehuis) && $vakantiehuis->images->isNotEmpty())
                            <label class="block text-sm font-medium text-gray-700">Huidige foto's</label>
                            <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach ($vakantiehuis->images as $image)
                                    <div class="relative">
                                        <img src="{{ $image->url }}" class="w-full h-32 object-cover rounded">
                                        <button type="button"
                                            class="absolute top-2 right-2 bg-red-600 text-white px-2 py-1 rounded delete-image-button"
                                            data-image-id="{{ $image->id }}">
                                            Verwijder
                                        </button>
                                        <input type="hidden" name="deleted_fotos[]" value=""
                                            id="deleted_foto_{{ $image->id }}">
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <label for="fotos" class="block text-sm font-medium text-gray-700">Nieuwe Foto's</label>
                        <input type="file" id="fotos" name="fotos[]" multiple
                            class="w-full mt-1 p-2 border border-gray-300 rounded-md" accept="image/*">
                    </div>

                    <div class="text-right">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg mt-4">
                            Vakantiehuis Bijwerken
                        </button>
                    </div>
                </form>

                <div id="map" class="w-full h-64 bg-gray-200 mt-10 rounded-lg shadow-lg"></div>
            </div>
        </div>
    </div>
</x-app-layout>
