<x-app-layout>
    <x-header />

    <div class="min-h-screen bg-green-100 py-8">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">Beschikbare Vakantiehuizen</h1>

            <div class="lg:flex lg:space-x-6">
                <!-- Pass the locations to the filter component -->
                <x-filter :locations="$locations" />

                <!-- Vacation Houses List with Search Bar -->
                <div class="w-full lg:w-3/4">
                    <!-- Search Bar -->
                    <div class="mb-4">
                        <form action="{{ route('huizen.index') }}" method="GET" class="flex items-center space-x-4">
                            <input type="text" name="query" value="{{ request('query') }}"
                                placeholder="Zoek op plaats, buurt of postcode"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
                            <button type="submit"
                                class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                                Zoek
                            </button>
                        </form>
                    </div>

                    <!-- Display Vacation Houses -->
                    @if ($huizen->isEmpty())
                        <p class="text-gray-600">Geen vakantiehuizen beschikbaar.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($huizen as $huis)
                                <div class="bg-white p-4 rounded-lg shadow">
                                    <img src="{{ $huis->afbeelding ?? 'https://placehold.co/400' }}"
                                        alt="{{ $huis->naam }}" class="w-full h-48 object-cover rounded-t-lg mb-4">
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
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
