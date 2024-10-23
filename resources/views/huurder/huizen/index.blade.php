<x-app-layout>
    <div class="flex lg:flex-nowrap flex-wrap min-h-screen">
        <x-sidebar title="Huizenbeheer">
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                    Huizen</a></li>
            <li><a href="{{ route('verhuurder.huizen.create') }}" class="text-gray-700 hover:text-green-600">Voeg Huis
                    Toe</a></li>
        </x-sidebar>

        <div class="w-full lg:w-3/4 p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">Mijn Vakantiehuizen</h1>

            @if ($huizen->isEmpty())
                <p class="text-gray-600">U heeft nog geen vakantiehuizen toegevoegd.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($huizen as $huis)
                        <div class="bg-white shadow rounded-lg p-4">
                            <img src="{{ $huis->images->first()->url ?? 'https://via.placeholder.com/150' }}"
                                alt="{{ $huis->naam }}" class="w-full h-40 object-cover rounded">
                            <h3 class="text-lg font-semibold mt-4">{{ $huis->naam }}</h3>
                            <p class="text-sm text-gray-600">{{ $huis->beschrijving }}</p>
                            <p class="text-green-600 font-bold">€ {{ $huis->prijs }}</p>
                            <div class="mt-2">
                                <a href="{{ route('verhuurder.huizen.edit', $huis->id) }}"
                                    class="text-blue-600 hover:underline">Bewerken</a>
                                <form action="{{ route('verhuurder.huizen.destroy', $huis->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:underline ml-2">Verwijderen</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
