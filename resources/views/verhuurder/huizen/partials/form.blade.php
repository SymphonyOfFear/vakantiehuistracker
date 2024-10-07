<!-- verhuurder/huizen/partials/form.blade.php -->
<form
    action="{{ isset($vakantiehuis) ? route('verhuurder.huizen.update', $vakantiehuis->id) : route('verhuurder.huizen.store') }}"
    method="POST" enctype="multipart/form-data">
    @csrf
    @if (isset($vakantiehuis))
        @method('PUT')
    @endif

    <!-- Naam -->
    <div class="mb-4">
        <label for="naam" class="block text-sm font-medium text-gray-700">Naam</label>
        <input type="text" id="naam" name="naam" value="{{ old('naam', $vakantiehuis->naam ?? '') }}"
            class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
    </div>

    <!-- Prijs -->
    <div class="mb-4">
        <label for="prijs" class="block text-sm font-medium text-gray-700">Prijs (€)</label>
        <input type="number" step="0.01" id="prijs" name="prijs"
            value="{{ old('prijs', $vakantiehuis->prijs ?? '') }}"
            class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
    </div>

    <!-- Beschrijving -->
    <div class="mb-4">
        <label for="beschrijving" class="block text-sm font-medium text-gray-700">Beschrijving</label>
        <textarea id="beschrijving" name="beschrijving" rows="4"
            class="w-full mt-1 p-2 border border-gray-300 rounded-md">{{ old('beschrijving', $vakantiehuis->beschrijving ?? '') }}</textarea>
    </div>

    <!-- Slaapkamers -->
    <div class="mb-4">
        <label for="slaapkamers" class="block text-sm font-medium text-gray-700">Aantal Slaapkamers</label>
        <input type="number" id="slaapkamers" name="slaapkamers"
            value="{{ old('slaapkamers', $vakantiehuis->slaapkamers ?? '') }}"
            class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
    </div>

    <!-- Stad met auto-suggestie -->
    <div class="mb-4">
        <label for="stad" class="block text-sm font-medium text-gray-700">Stad</label>
        <div class="relative">
            <input type="text" id="stad" name="stad" value="{{ old('stad', $vakantiehuis->stad ?? '') }}"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md" placeholder="Voer een stad of locatie in"
                autocomplete="off">
            <div id="stad-suggestions"
                class="absolute z-10 w-full bg-white shadow-lg border border-gray-200 mt-1 rounded-md max-h-60 overflow-y-auto hidden">
                <!-- Suggestions will be dynamically added here by JS -->
            </div>
        </div>
    </div>

    <!-- Straatnaam -->
    <div class="mb-4">
        <label for="straatnaam" class="block text-sm font-medium text-gray-700">Straatnaam</label>
        <input type="text" id="straatnaam" name="straatnaam"
            value="{{ old('straatnaam', $vakantiehuis->straatnaam ?? '') }}"
            class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
    </div>

    <!-- Postcode -->
    <div class="mb-4">
        <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode</label>
        <input type="text" id="postcode" name="postcode"
            value="{{ old('postcode', $vakantiehuis->postcode ?? '') }}"
            class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
    </div>

    <!-- Huisnummer -->
    <div class="mb-4">
        <label for="huisnummer" class="block text-sm font-medium text-gray-700">Huisnummer</label>
        <input type="text" id="huisnummer" name="huisnummer"
            value="{{ old('huisnummer', $vakantiehuis->huisnummer ?? '') }}"
            class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
    </div>

    <!-- Voorzieningen -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Voorzieningen</label>
        <div class="flex flex-wrap">
            <label class="mr-4 mb-2"><input type="checkbox" name="wifi" value="1"
                    {{ isset($vakantiehuis) && $vakantiehuis->wifi ? 'checked' : '' }}> Wi-Fi</label>
            <label class="mr-4 mb-2"><input type="checkbox" name="zwembad" value="1"
                    {{ isset($vakantiehuis) && $vakantiehuis->zwembad ? 'checked' : '' }}> Zwembad</label>
            <label class="mr-4 mb-2"><input type="checkbox" name="parkeren" value="1"
                    {{ isset($vakantiehuis) && $vakantiehuis->parkeren ? 'checked' : '' }}> Parkeerplaats</label>
            <label class="mr-4 mb-2"><input type="checkbox" name="speeltuin" value="1"
                    {{ isset($vakantiehuis) && $vakantiehuis->speeltuin ? 'checked' : '' }}> Speeltuin</label>
        </div>
    </div>

    <!-- Beschikbaarheid -->
    <div class="mb-4">
        <label for="beschikbaarheid" class="block text-sm font-medium text-gray-700">Beschikbaarheid</label>
        <select id="beschikbaarheid" name="beschikbaarheid" class="w-full mt-1 p-2 border border-gray-300 rounded-md"
            required>
            <option value="1" {{ isset($vakantiehuis) && $vakantiehuis->beschikbaarheid ? 'selected' : '' }}>Ja
            </option>
            <option value="0" {{ isset($vakantiehuis) && !$vakantiehuis->beschikbaarheid ? 'selected' : '' }}>Nee
            </option>
        </select>
    </div>

    <!-- Huidige foto's -->
    @if (isset($vakantiehuis) && $vakantiehuis->images->isNotEmpty())
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Huidige foto's</label>
            <div id="current-image-previews" class="mt-4 grid grid-cols-4 gap-4">
                @foreach ($vakantiehuis->images as $image)
                    <div class="relative">
                        <img src="{{ $image->url }}" class="w-full h-32 object-cover rounded">
                        <!-- Delete button for each existing image -->
                        <button type="button"
                            class="absolute top-2 right-2 bg-red-600 text-white px-2 py-1 rounded delete-image-button"
                            data-image-id="{{ $image->id }}">Verwijder</button>
                        <!-- Hidden input to mark image for deletion -->
                        <input type="hidden" name="deleted_fotos[]" value=""
                            id="deleted_foto_{{ $image->id }}">
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Nieuwe foto's -->
    <div class="mb-4">
        <label for="fotos" class="block text-sm font-medium text-gray-700">Nieuwe Foto's</label>
        <input type="file" id="fotos" name="fotos[]" multiple
            class="w-full mt-1 p-2 border border-gray-300 rounded-md" accept="image/*">
        <div id="image-previews" class="mt-4 grid grid-cols-4 gap-4">
            <!-- Image previews for new uploads will be inserted here by JavaScript -->
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">
        {{ isset($vakantiehuis) ? 'Vakantiehuis Bijwerken' : 'Vakantiehuis Aanmaken' }}
    </button>
</form>
