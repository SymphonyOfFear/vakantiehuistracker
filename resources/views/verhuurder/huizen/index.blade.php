<x-app-layout>
    <div class="flex lg:flex-nowrap flex-wrap min-h-screen">

        <x-sidebar title="Mijn Huizen" class="lg:min-h-screen">
            <li><a href="{{ route('verhuurder.dashboard') }}" class="text-gray-700 hover:text-green-600">Dashboard</a>
            </li>
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                    Huizen</a></li>
            <li><a href="{{ route('recensies.index') }}" class="text-gray-700 hover:text-green-600">Recensies</a></li>
            <li><a href="{{ route('reserveringen.index') }}" class="text-gray-700 hover:text-green-600">Reserveringen</a>
            </li>
            <li><a href="{{ route('favorieten.index') }}" class="text-gray-700 hover:text-green-600">Favorieten</a></li>
        </x-sidebar>

        <div class="w-full lg:w-3/4 p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">Mijn Vakantiehuizen</h1>

            @if ($huisjes->isEmpty())
                <p class="text-gray-600">Je hebt nog geen vakantiehuizen toegevoegd.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($huisjes as $huis)
                        <div class="relative bg-white p-4 rounded-lg shadow">
                            <img src="{{ asset($huis->images->first()->url ?? 'images/placeholder.png') }}"
                                alt="{{ $huis->naam }}" class="w-full h-48 object-cover rounded-t-lg mb-4">
                            <h3 class="text-xl font-bold text-gray-800">{{ $huis->naam }}</h3>
                            <p class="text-gray-600">{{ $huis->straatnaam }} {{ $huis->huisnummer }},
                                {{ $huis->stad }}</p>
                            <p class="text-green-600 font-semibold">€ {{ $huis->prijs }}</p>

                            <a href="{{ route('verhuurder.huizen.show', $huis->id) }}"
                                class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                                Bekijk details
                            </a>

                            <form action="{{ route('verhuurder.huizen.destroy', $huis->id) }}" method="POST"
                                class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                                    Verwijder
                                </button>
                            </form>

                            <form class="absolute bottom-4 right-4 favorite-form" data-id="{{ $huis->id }}"
                                method="POST" action="{{ route('favorieten.toggle', $huis->id) }}">
                                @csrf
                                <button type="submit" class="favorite-button text-2xl" title="Toggle favorite">
                                    <i
                                        class="fas fa-heart {{ $huis->favorieten()->where('user_id', Auth::id())->exists() ? 'text-red-600' : 'text-black' }}"></i>
                                </button>
                            </form>
                        </div>
                        <form action="{{ route('verhuurder.huizen.destroy', $huis->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-red-600 hover:text-red-900 focus:outline-none focus:border-red-700 focus:ring-red active:text-red-700 transition ease-in-out duration-150">
                                Delete
                            </button>
                        </form>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
