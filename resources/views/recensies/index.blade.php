<x-app-layout>


    <div class="min-h-screen bg-green-100 py-16">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">Recensies van Vakantiehuizen</h1>

            @if ($recensies->isEmpty())
                <p class="text-gray-600">Er zijn momenteel geen recensies voor je vakantiehuizen.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- Loop through the reviews --}}
                    @foreach ($recensies as $recensie)
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="text-xl font-bold text-gray-800">{{ $recensie->vakantiehuis->naam }}</h3>
                            <p class="text-gray-600">Gepubliceerd door: {{ $recensie->huurder->name }}</p>
                            <p class="text-green-600 font-semibold">Rating: {{ $recensie->rating }} / 5</p>
                            <p class="text-gray-600">{{ $recensie->feedback }}</p>
                            <a href="{{ route('recensies.show', $recensie->id) }}"
                                class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                Bekijk details
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>


</x-app-layout>
