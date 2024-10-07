<x-app-layout>
    <x-header />

    <div class="flex bg-gray-50 min-h-screen">
        <!-- Sidebar / Filters -->
        <x-filter :locationsList="$locationsList" class="w-full lg:w-1/4 bg-white p-6 shadow-md" />

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-6 bg-gray-50">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Vakantiehuizen</h1>

            @if ($vakantiehuizen->isEmpty())
                <p class="text-gray-600 text-lg">Geen vakantiehuizen beschikbaar.</p>
            @else
                <!-- List of Vacation Homes -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($vakantiehuizen as $huis)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <!-- Display the image or placeholder if no image exists -->
                            <img src="{{ $huis->images->first()->url ?? 'https://via.placeholder.com/400x300.png?text=Vakantiehuis' }}"
                                alt="{{ $huis->naam }}" class="w-full h-48 object-cover rounded-t-lg">

                            <div class="p-4">
                                <h3 class="text-xl font-semibold text-gray-800 mb-1">{{ $huis->naam }}</h3>
                                <p class="text-gray-500 mb-2">{{ $huis->postcode }} {{ $huis->stad }}</p>
                                <p class="text-green-600 font-semibold text-lg">€{{ $huis->prijs }}</p>

                                <a href="{{ route('huizen.show', $huis->id) }}"
                                    class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-transform transform hover:scale-105">Bekijk details</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <x-footer />
</x-app-layout>
