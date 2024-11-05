<x-app-layout>
    <div class="flex lg:flex-nowrap flex-wrap min-h-screen">

        <x-sidebar title="Recensies Beheer">
            <li><a href="{{ route('recensies.index') }}" class="text-gray-700 hover:text-green-600">Mijn Recensies</a>
            </li>
            <li><a href="{{ route('verhuurder.dashboard') }}" class="text-gray-700 hover:text-green-600">Dashboard</a>
            </li>
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                    Huizen</a></li>
        </x-sidebar>

        <div class="w-full lg:w-3/4 p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">Mijn Recensies</h1>

            @if ($recensies->isEmpty())
                <p class="text-gray-600">U heeft nog geen recensies ontvangen.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($recensies as $recensie)
                        <div class="bg-white shadow rounded-lg p-4">
                            <h3 class="text-lg font-semibold">{{ $recensie->titel }}</h3>
                            <p class="text-sm text-gray-600">{{ $recensie->inhoud }}</p>
                            <p class="text-yellow-500 font-semibold mt-2">Rating: {{ $recensie->rating }} / 5</p>
                            <p class="text-gray-500 text-xs">Door {{ $recensie->gebruiker->name }}</p>
                            <div class="mt-2">
                                <a href="{{ route('recensies.show', $recensie->id) }}"
                                    class="text-blue-600 hover:underline">Bekijk</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
