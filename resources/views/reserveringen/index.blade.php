<x-app-layout>
    <div class="flex lg:flex-nowrap flex-wrap min-h-screen">

        <x-sidebar title="Reserveringen Beheer">
            <li><a href="{{ route('reserveringen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                    Reserveringen</a></li>
            <li><a href="{{ route('verhuurder.dashboard') }}" class="text-gray-700 hover:text-green-600">Dashboard</a>
            </li>
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                    Huizen</a></li>
        </x-sidebar>

        <div class="w-full lg:w-3/4 p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">Mijn Reserveringen</h1>

            @if ($reserveringen->isEmpty())
                <p class="text-gray-600">U heeft nog geen reserveringen.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($reserveringen as $reservering)
                        <div class="bg-white shadow rounded-lg p-4">
                            <h3 class="text-lg font-semibold">Reservering #{{ $reservering->id }}</h3>
                            <p class="text-sm text-gray-600">Vakantiehuis: {{ $reservering->vakantiehuis->naam }}</p>
                            <p class="text-sm text-gray-600">Begindatum: {{ $reservering->begindatum }}</p>
                            <p class="text-sm text-gray-600">Einddatum: {{ $reservering->einddatum }}</p>
                            <p class="text-green-500 font-semibold mt-2">{{ $reservering->status }}</p>
                            <div class="mt-2">
                                <a href="{{ route('reserveringen.show', $reservering->id) }}"
                                    class="text-blue-600 hover:underline">Bekijk</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
