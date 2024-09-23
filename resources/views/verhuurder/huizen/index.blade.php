<x-app-layout>
    <x-header />

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
                {{-- @foreach ($huizen as $huis)
                    <div class="bg-white p-4 rounded-lg shadow">
                        <img src="{{ $huis->afbeelding ?? 'https://placehold.co/400' }}" alt="{{ $huis->naam }}"
                            class="w-full h-48 object-cover rounded-t-lg mb-4">
                        <h3 class="text-xl font-bold text-gray-800">{{ $huis->naam }}</h3>
                        <p class="text-gray-600">{{ $huis->locatie }}</p>
                        <p class="text-green-600 font-semibold">€ {{ $huis->prijs }}</p>
                        <a href="{{ route('verhuurder.huizen.show', $huis->id) }}"
                            class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                            Bekijk details
                        </a>
                    </div>
                @endforeach --}}
            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
