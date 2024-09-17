<x-app-layout>
    <x-header />

    <div class="min-h-screen bg-green-100 py-16">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">Mijn Reserveringen</h1>

            @if ($reserveringen->isEmpty())
                <p class="text-gray-600">Je hebt momenteel geen reserveringen.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- Loop through reservations --}}
                    @foreach ($reserveringen as $reservering)
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="text-xl font-bold text-gray-800">{{ $reservering->vakantiehuis->naam }}</h3>
                            <p class="text-gray-600">Locatie: {{ $reservering->vakantiehuis->locatie }}</p>
                            <p class="text-green-600 font-semibold">Prijs: € {{ $reservering->vakantiehuis->prijs }}</p>
                            <p class="text-gray-600">Startdatum: {{ $reservering->startdatum }}</p>
                            <p class="text-gray-600">Einddatum: {{ $reservering->einddatum }}</p>
                            <a href="{{ route('reserveringen.show', $reservering->id) }}"
                                class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                Bekijk details
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <x-footer />
</x-app-layout>
