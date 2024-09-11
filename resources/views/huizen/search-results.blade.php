<x-app-layout>
    <div class="container mx-auto py-8">
        <h2 class="text-3xl font-semibold text-gray-700">Zoekresultaten voor "{{ $query }}"</h2>

        <!-- Resultatenlijst -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-6">
            @foreach ($huizen as $huis)
                <div class="border p-4 rounded-lg shadow">
                    <h3 class="text-xl font-semibold">{{ $huis->name }}</h3>
                    <p class="text-gray-600">{{ $huis->location }}</p>
                    <p class="text-gray-800">{{ $huis->price }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
