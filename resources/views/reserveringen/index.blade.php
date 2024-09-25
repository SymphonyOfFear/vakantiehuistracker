<x-app-layout>
    <x-header />

    <div class="min-h-screen bg-green-100 py-16">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">Mijn Reserveringen</h1>

            <h2 class="text-xl font-semibold mt-8 mb-2">Vakantiehuizen die ik huur</h2>
            @if ($gehuurdeHuizen->isEmpty())
                <p class="text-gray-600">U huurt momenteel geen vakantiehuizen.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($gehuurdeHuizen as $huis)
                        <div class="bg-white p-4 rounded-lg shadow">
                            <img src="{{ $huis->fotos[0] ?? 'https://placehold.co/400' }}" alt="{{ $huis->naam }}"
                                class="w-full h-48 object-cover rounded-t-lg mb-4">
                            <h3 class="text-xl font-bold text-gray-800">{{ $huis->naam }}</h3>
                            <p class="text-gray-600">{{ $huis->adres }}</p>
                            <p class="text-green-600 font-semibold">€{{ $huis->prijs }}</p>
                            <div class="mt-4">
                                <a href="{{ route('verhuurder.huizen.show', $huis->id) }}"
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Bekijk</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <x-footer />
</x-app-layout>
