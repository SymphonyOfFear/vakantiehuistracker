<!-- verhuurder/huizen/index.blade.php -->
<x-app-layout>
    <x-header />

    <div class="flex">
        <!-- Sidebar -->
        <x-sidebar title="Huizenbeheer">
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                    Huizen</a></li>
            <li><a href="{{ route('verhuurder.huizen.create') }}" class="text-gray-700 hover:text-green-600">Voeg Huis
                    Toe</a></li>
        </x-sidebar>

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">Mijn Vakantiehuizen</h1>

            <!-- Vakantiehuizen die de gebruiker verhuurt -->
            <h2 class="text-xl font-semibold mb-2">Vakantiehuizen die ik verhuur</h2>
            @if ($mijnHuizen->isEmpty())
                <p class="text-gray-600">U heeft momenteel geen vakantiehuizen.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($mijnHuizen as $huis)
                        <div
                            class="relative bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                            <!-- Controleer of er afbeeldingen zijn en toon de eerste afbeelding -->
                            @if ($huis->images->isNotEmpty())
                                <img src="{{ $huis->images->first()->url }}" alt="{{ $huis->naam }}"
                                    class="w-full h-48 object-cover rounded-t-lg mb-4">
                            @else
                                <!-- Toon een placeholder als er geen afbeeldingen zijn -->
                                <img src="https://via.placeholder.com/400x300.png?text=Geen+Afbeelding"
                                    alt="Geen afbeelding beschikbaar"
                                    class="w-full h-48 object-cover rounded-t-lg mb-4">
                            @endif

                            <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $huis->naam }}</h3>
                            <p class="text-gray-600 mb-1">{{ $huis->straatnaam }} {{ $huis->huisnummer }},
                                {{ $huis->stad }}</p>
                            <p class="text-green-600 font-semibold mb-4">€{{ $huis->prijs }}</p>

                            <div class="flex justify-between items-center">
                                <div>
                                    <a href="{{ route('verhuurder.huizen.show', $huis->id) }}"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Bekijk</a>
                                    <a href="{{ route('verhuurder.huizen.edit', $huis->id) }}"
                                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700 transition ml-2">Bewerk</a>
                                </div>
                                <!-- Toevoegen aan favorieten knop -->
                                <form action="{{ route('favorieten.toggle', $huis->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    <button type="submit" class="favorite-button text-2xl">
                                        <i
                                            class="fas fa-heart {{ $huis->isFavoritedBy(Auth::id()) ? 'text-red-600' : 'text-black' }}"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <x-footer />
</x-app-layout>
