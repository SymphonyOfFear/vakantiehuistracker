<x-app-layout>
    <div class="flex lg:flex-nowrap flex-wrap min-h-screen">
        <!-- Sidebar -->
        <x-sidebar title="Huizenbeheer">
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn Huizen</a></li>
            <li><a href="{{ route('verhuurder.huizen.create') }}" class="text-gray-700 hover:text-green-600">Voeg Huis Toe</a></li>
        </x-sidebar>

        <!-- Main Content Area -->
        <div class="flex-grow p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">Mijn Vakantiehuizen</h1>

            @if ($huisjes->isEmpty())
                <p class="text-gray-600">U heeft nog geen vakantiehuizen toegevoegd.</p>
            @else
                <!-- Card Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($huisjes as $huis)
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden flex flex-col justify-between h-full">
                            <!-- Image -->
                            <img src="{{ $huis->images->first()->url ?? 'https://via.placeholder.com/300x200' }}"
                                 alt="{{ $huis->naam }}" class="w-full h-40 object-cover rounded-t-lg">

                            <!-- Content -->
                            <div class="p-4 flex-grow">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $huis->naam }}</h3>
                                <p class="text-sm text-gray-600 mt-2">{{ Str::limit($huis->beschrijving, 80) }}</p>
                                <p class="text-green-600 font-bold mt-2">€ {{ number_format($huis->prijs, 2) }}</p>
                            </div>

                            <!-- Actions -->
                            <div class="p-4 bg-gray-50 flex justify-between items-center">
                                <a href="{{ route('verhuurder.huizen.edit', $huis->id) }}" class="text-blue-600 hover:underline">Bewerken</a>
                                <form action="{{ route('verhuurder.huizen.destroy', $huis->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline ml-2">Verwijderen</button>
                                </form>
                                <a href="{{ route('huizen.show', $huis->id) }}" class="text-green-600 hover:underline ml-4">Tonen</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
