<x-app-layout>
    <x-header />

    <div class="flex">
        <!-- Sidebar / Filters -->
        <x-filter :locationsList="$locationsList" />

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">Vakantiehuizen</h1>

            @if ($vakantiehuizen->isEmpty())
                <p class="text-gray-600">Geen vakantiehuizen beschikbaar.</p>
            @else
                <!-- List of Vacation Homes -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                    @foreach ($vakantiehuizen as $huis)
                        <div class="bg-white p-4 rounded-lg shadow">
                            <!-- Display the image or placeholder if no image exists -->
                            <img src="{{ $huis->images->first()->url ?? 'https://via.placeholder.com/400x300.png?text=Vakantiehuis' }}"
                                alt="{{ $huis->naam }}" class="w-full h-48 object-cover rounded-t-lg mb-4">

                            <h3 class="text-xl font-bold text-gray-800">{{ $huis->naam }}</h3>
                            <p class="text-gray-600">{{ $huis->postcode }} {{ $huis->stad }}</p>
                            <p class="text-green-600 font-semibold">€{{ $huis->prijs }}</p>
                            <a href="{{ route('huizen.show', $huis->id) }}"
                                class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Bekijk
                                details</a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <x-footer />
</x-app-layout>
