<!-- verhuurder/huizen/index.blade.php -->
<x-app-layout>
    <x-header />

<<<<<<< HEAD

    <div class="min-h-screen bg-green-100 py-16">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">Mijn Vakantiehuizen</h1>
            <a href="{{ route('verhuurder.huizen.toevoegen') }}"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                Huis Toevoegen
            </a>
            <!-- List of vacation houses added by the landlord -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- Loop through the houses --}}
                @foreach ($huisjes as $huisje)
                    <div class="bg-white p-4 rounded-lg shadow">
                        <img src="{{ $huisje->afbeelding ?? 'https://placehold.co/400' }}" alt="{{ $huisje->naam }}"
                            class="w-full h-48 object-cover rounded-t-lg mb-4">
                        <h3 class="text-xl font-bold text-gray-800">{{ $huisje->naam }}</h3>
                        <p class="text-gray-600">Locatie: {{ $huisje->locatie }}</p>
                        <p class="text-green-600 font-semibold">€ {{ $huisje->prijs }}</p>
                        <a href="{{ route('verhuurder.huizen.show', $huisje->id) }}"
                            class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                            Bekijk details
                        </a>
                        <a href="{{ route('verhuurder.huizen.bewerken', $huisje->id) }}"
                            class="mt-4 inline-block bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                            Bewerk Vakantiehuis
                        </a>
                        <form action="{{ route('verhuurder.huizen.destroy', $huisje->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-red-600 hover:text-red-900 focus:outline-none focus:border-red-700 focus:ring-red active:text-red-700 transition ease-in-out duration-150">
                                Delete
                            </button>
                        </form>

                    </div>
                @endforeach

=======
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

                            <h3 class="text-xl font-bold text-gray-800">{{ $huis->naam }}</h3>
                            <p class="text-gray-600">{{ $huis->straatnaam }} {{ $huis->huisnummer }},
                                {{ $huis->stad }}</p>
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
>>>>>>> mikey-backend
        </div>
    </div>

    <x-footer />
</x-app-layout>
