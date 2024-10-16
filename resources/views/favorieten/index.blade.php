<x-app-layout>
    <x-header />

    <div class="min-h-screen bg-green-100 py-16">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">Mijn Favoriete Vakantiehuizen</h1>

            @if ($favorieten->isEmpty())
                <p class="text-gray-600">Je hebt nog geen vakantiehuizen aan je favorieten toegevoegd.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- Loop through the favorites --}}
                    @foreach ($favorieten as $huis)
                        <div class="bg-white p-4 rounded-lg shadow">
                            <img src="{{ $huis->afbeelding ?? 'https://placehold.co/400' }}" alt="{{ $huis->naam }}"
                                class="w-full h-48 object-cover rounded-t-lg mb-4">
                            <h3 class="text-xl font-bold text-gray-800">{{ $huis->naam }}</h3>
                            <p class="text-gray-600">{{ $huis->locatie }}</p>
                            <p class="text-green-600 font-semibold">€ {{ $huis->prijs }}</p>

                            <a href="{{ route('huizen.show', $huis->id) }}"
                                class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                Bekijk details
                            </a>

                            <!-- Remove from favorites -->
                            <form action="{{ route('favorieten.verwijderen', $huis->id) }}" method="POST"
                                class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                    Verwijder uit favorieten
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <x-footer />
</x-app-layout>
