<x-app-layout>
    <x-header />

    <div class="flex">
        <!-- Sidebar Filters -->
        <div class="w-1/4 p-6 bg-gray-100 h-screen sticky top-0">
            <h2 class="text-xl font-semibold mb-4">Filters</h2>

            <!-- Filter Component -->
            <x-filter :locations="$locations" />
        </div>

        <!-- Main Content -->
        <div class="w-3/4 p-6 bg-white">

            <!-- Grote Zoekbalk met zoekknop -->
            <form action="{{ route('huizen.index') }}" method="GET" class="mb-4 flex items-center space-x-2">
                <input type="text" name="zoekterm" placeholder="Zoek vakantiehuizen"
                    class="w-full p-4 text-lg border border-gray-300 rounded-md" />
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg">Zoeken</button>
            </form>

            <!-- Vakantiehuizen -->
            @if ($vakantiehuizen->isEmpty())
                <p class="text-gray-600">Geen vakantiehuizen beschikbaar.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                    @foreach ($vakantiehuizen as $huis)
                        <div class="bg-white p-4 rounded-lg shadow">
                            <img src="{{ $huis->fotos[0] ?? 'https://placehold.co/400' }}" alt="{{ $huis->naam }}"
                                class="w-full h-48 object-cover rounded-t-lg mb-4">
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
