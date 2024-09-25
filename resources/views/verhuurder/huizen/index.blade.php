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

            <!-- Huizen die de gebruiker verhuurt -->
            <h2 class="text-xl font-semibold mb-2">Vakantiehuizen die ik verhuur</h2>
            @if ($mijnHuizen->isEmpty())
                <p class="text-gray-600">U heeft momenteel geen vakantiehuizen.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($mijnHuizen as $huis)
                        <div class="bg-white p-4 rounded-lg shadow">
                            <img src="{{ $huis->fotos[0] ?? 'https://placehold.co/400' }}" alt="{{ $huis->naam }}"
                                class="w-full h-48 object-cover rounded-t-lg mb-4">
                            <h3 class="text-xl font-bold text-gray-800">{{ $huis->naam }}</h3>
                            <p class="text-gray-600">{{ $huis->adres }}</p>
                            <p class="text-green-600 font-semibold">€{{ $huis->prijs }}</p>
                            <div class="mt-4">
                                <a href="{{ route('verhuurder.huizen.show', $huis->id) }}"
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Bekijk</a>
                                <a href="{{ route('verhuurder.huizen.edit', $huis->id) }}"
                                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700 transition ml-2">Bewerk</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Huizen die de gebruiker huurt -->

        </div>
    </div>

    <x-footer />
</x-app-layout>
