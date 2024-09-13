<x-app-layout>
    <div class="container mx-auto py-8">
        <h2 class="text-3xl font-semibold text-gray-700 mb-6">Zoekresultaten voor "{{ $query }}"</h2>

        <!-- Controleer of er huizen zijn -->
        @if (count($huizen) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($huizen as $huis)
                    <div class="bg-white p-4 rounded-lg shadow">
                        <!-- Simuleer afbeelding -->
                        <img src="{{ asset('images/' . $huis->image) }}" alt="{{ $huis->name }}"
                            class="w-full h-48 object-cover rounded-t-lg mb-4">
                        <h3 class="text-xl font-bold">{{ $huis->name }}</h3>
                        <p>{{ $huis->location }}</p>
                        <p class="text-green-600">{{ $huis->price }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-700 text-lg">Geen resultaten gevonden voor "{{ $query }}".</p>
        @endif
    </div>
</x-app-layout>
