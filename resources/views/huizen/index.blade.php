<x-app-layout>
    <div class="flex">
     <x-filter>
     </x-filter>

        <!-- Resultaten -->
        <div class="w-full p-6">
            <h1 class="text-2xl font-bold mb-4">Vakantiehuizen</h1>

            <!-- Controleer of er resultaten zijn -->
            @if($huizen->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($huizen as $vakantiehuis)
                        <div class="bg-white shadow rounded-lg p-4">
                            <img src="{{ asset($vakantiehuis->images->first()->url) }}" alt="{{ $vakantiehuis->naam }}" class="w-full h-48 object-cover rounded-md mb-4">
                            <h2 class="text-xl font-semibold mb-2">{{ $vakantiehuis->naam }}</h2>
                            <p class="text-gray-600">{{ $vakantiehuis->stad }}, {{ $vakantiehuis->straatnaam }}</p>
                            <p class="text-green-600 font-bold mt-2">€{{ number_format($vakantiehuis->prijs, 2) }} per nacht</p>
                            <a href="{{ route('huizen.show', $vakantiehuis->id) }}" class="text-blue-600 mt-4 inline-block">Bekijk meer</a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 mt-6">Geen vakantiehuizen beschikbaar.</p>
            @endif
        </div>
    </div>
</x-app-layout>
