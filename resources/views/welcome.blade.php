<!-- welcome.blade.php -->
<x-app-layout>
    <x-header />

    <div class="container mx-auto py-12">
        <h1 class="text-4xl font-bold text-center mb-8">Vakantiehuizen Zoeken</h1>

        <!-- Search Form -->
        <form action="{{ route('huizen.index') }}" method="GET" class="w-full max-w-lg mx-auto">
            <div class="relative">
                <input type="text" id="search-location" name="zoekopdracht" placeholder="Voer een locatie of adres in"
                    class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none"
                    value="{{ request('zoekopdracht') }}">
                <div id="location-suggestions"
                    class="absolute z-10 w-full bg-white shadow-lg border border-gray-200 mt-1 rounded-md max-h-60 overflow-y-auto hidden">
                    <!-- Suggestions will be dynamically added here by JS -->
                </div>
            </div>
            <button type="submit"
                class="mt-4 px-8 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Zoeken</button>
        </form>
    </div>

    <x-footer />
</x-app-layout>
