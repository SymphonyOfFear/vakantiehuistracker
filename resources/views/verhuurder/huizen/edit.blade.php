<x-app-layout>
    <x-header />

    <div class="flex">
        <!-- Sidebar -->
        <x-sidebar title="Huizenbeheer">
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                    Huizen</a></li>
        </x-sidebar>

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">Bewerk vakantiehuis</h1>

            <form action="{{ route('verhuurder.huizen.update', $vakantiehuis->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700">Naam van Vakantiehuis:</label>
                    <input type="text" name="name" value="{{ $vakantiehuis->name }}"
                        class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Locatie:</label>
                    <select name="location" class="w-full border rounded px-3 py-2 select-search" required>
                        <!-- Dynamic location options -->
                        @foreach ($locations as $location)
                            <option value="{{ $location }}"
                                {{ $vakantiehuis->location == $location ? 'selected' : '' }}>{{ $location }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Prijs per nacht:</label>
                    <input type="number" name="price" value="{{ $vakantiehuis->price }}"
                        class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Aantal slaapkamers:</label>
                    <input type="number" name="bedrooms" value="{{ $vakantiehuis->bedrooms }}"
                        class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Voorzieningen:</label>
                    <input type="checkbox" name="amenities[]" value="Zwembad"
                        {{ in_array('Zwembad', $vakantiehuis->amenities) ? 'checked' : '' }}> Zwembad <br>
                    <input type="checkbox" name="amenities[]" value="Wi-Fi"
                        {{ in_array('Wi-Fi', $vakantiehuis->amenities) ? 'checked' : '' }}> Wi-Fi <br>
                    <input type="checkbox" name="amenities[]" value="Spa"
                        {{ in_array('Spa', $vakantiehuis->amenities) ? 'checked' : '' }}> Spa <br>
                    <input type="checkbox" name="amenities[]" value="Speeltuin"
                        {{ in_array('Speeltuin', $vakantiehuis->amenities) ? 'checked' : '' }}> Speeltuin
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Afbeelding van vakantiehuis:</label>
                    <input type="file" name="photo" class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Bijwerken</button>
                </div>
            </form>
        </div>
    </div>

    <x-footer />
</x-app-layout>
