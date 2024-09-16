<x-app-layout>
    <div class="min-h-screen flex flex-col">
        <!-- Header Component -->
        <x-header />

        <!-- Vacation Houses Listing with Filters Sidebar -->
        <div class="flex-grow bg-green-100 py-16">
            <div class="container mx-auto">
                <h1 class="text-3xl font-semibold text-gray-700 mb-6">Beschikbare Vakantiehuizen</h1>

                <div class="lg:flex lg:space-x-6">
                    <!-- Filter Form (Sidebar) -->
                    <div class="w-full lg:w-1/4 bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-xl font-semibold mb-4">Filters</h2>
                        <form action="{{ route('huizen.index') }}" method="GET" class="space-y-4">
                            <!-- Locatie Filter (Searchable Dropdown) -->
                            <div class="flex flex-col">
                                <label for="locatie" class="text-gray-600 mb-2">Locatie</label>
                                <select name="locatie" id="locatie"
                                    class="select-search px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
                                    <option value="">Selecteer een locatie</option>
                                    @if (isset($locations) && is_array($locations))
                                        @foreach ($locations as $locatie)
                                            <option value="{{ $locatie['name'] }}">{{ $locatie['name'] }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Geen locaties beschikbaar</option>
                                    @endif
                                </select>
                            </div>

                            <!-- Minimale Prijs Filter -->
                            <div class="flex flex-col">
                                <label for="min_prijs" class="text-gray-600 mb-2">Minimale Prijs</label>
                                <input type="number" name="min_prijs" id="min_prijs" value="{{ request('min_prijs') }}"
                                    class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500"
                                    placeholder="0">
                            </div>

                            <!-- Maximale Prijs Filter -->
                            <div class="flex flex-col">
                                <label for="max_prijs" class="text-gray-600 mb-2">Maximale Prijs</label>
                                <input type="number" name="max_prijs" id="max_prijs" value="{{ request('max_prijs') }}"
                                    class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500"
                                    placeholder="Geen max">
                            </div>

                            <!-- Soort Aanbod Filter (Checkboxes) -->
                            <div class="flex flex-col">
                                <label class="text-gray-600 mb-2">Soort Aanbod</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="woonhuis" id="woonhuis" class="mr-2"
                                        {{ request('woonhuis') ? 'checked' : '' }}>
                                    <label for="woonhuis" class="text-gray-700">Woonhuis</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="appartement" id="appartement" class="mr-2"
                                        {{ request('appartement') ? 'checked' : '' }}>
                                    <label for="appartement" class="text-gray-700">Appartement</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="parkeergelegenheid" id="parkeergelegenheid"
                                        class="mr-2" {{ request('parkeergelegenheid') ? 'checked' : '' }}>
                                    <label for="parkeergelegenheid" class="text-gray-700">Parkeergelegenheid</label>
                                </div>
                            </div>

                            <!-- Filter Button -->
                            <div class="flex">
                                <button type="submit"
                                    class="w-full px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                                    Filter
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Vacation Houses Grid with Search Bar Above -->
                    <div class="w-full lg:w-3/4">
                        <!-- Search Bar Above the Results -->
                        <div class="bg-white p-4 mb-6 rounded-lg shadow-md">
                            <form action="{{ route('huizen.search') }}" method="GET" class="flex space-x-4">
                                <div class="w-full lg:max-w-3xl">
                                    <input type="text" name="search" placeholder="Zoek op plaats, buurt of postcode"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
                                </div>
                                <button type="submit"
                                    class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                                    Zoek
                                </button>
                            </form>
                        </div>

                        <!-- Vacation Houses Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6 lg:mt-0">
                            @foreach ($huizen as $huis)
                                <div class="bg-white p-4 rounded-lg shadow">
                                    <img src="{{ $huis->afbeelding }}" alt="Vakantiehuis"
                                        class="w-full h-48 object-cover rounded-t-lg mb-4">
                                    <h3 class="text-xl font-bold text-gray-800">{{ $huis->naam }}</h3>
                                    <p class="text-gray-600">{{ $huis->locatie }}</p>
                                    <p class="text-green-600 font-semibold">€ {{ $huis->prijs }}</p>
                                    <a href="{{ route('huizen.show', $huis->id) }}"
                                        class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                        Bekijk details
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Component -->
        <x-footer />
    </div>

    <!-- Initialize Tom Select for the Searchable Dropdown -->

</x-app-layout>
