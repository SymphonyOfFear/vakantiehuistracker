<x-app-layout>
    <x-header />

    <div class="min-h-screen bg-green-100 py-8">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">Beschikbare Vakantiehuizen</h1>

            <div class="lg:flex lg:space-x-6">
                <!-- Pass the locations to the filter component -->
                <x-filter :locations="$locations" />

                <!-- Vacation Houses List with Search Bar -->
                <div class="w-full lg:w-3/4">
                    <!-- Search Bar -->
                    <div class="mb-4">
                        <form action="{{ route('huizen.index') }}" method="GET" class="flex items-center space-x-4">
                            <input type="text" name="query" value="{{ request('query') }}"
                                placeholder="Zoek op plaats, buurt of postcode"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
                            <button type="submit"
                                class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                                Zoek
                            </button>
                        </form>
                    </div>

                    <!-- Display Vacation Houses -->
                    @if ($huizen->isEmpty())
                        <p class="text-gray-600">Geen vakantiehuizen beschikbaar.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($huizen as $huis)
                                <div class="bg-white p-4 rounded-lg shadow relative">
                                    <!-- Favorite Button -->
                                    @auth
                                        <form action="{{ route('favorieten.toggle', $huis->id) }}" method="POST"
                                            class="absolute top-2 right-2">
                                            @csrf
                                            @method('POST')
                                            <button type="submit"
                                                class="text-yellow-500 hover:text-yellow-600 focus:outline-none">
                                                @if (auth()->user()->favorieten->contains($huis->id))
                                                    <!-- Filled Star for favorited houses -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                        fill="currentColor" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11.049 2.927a1 1 0 011.902 0l2.065 4.186a1 1 0 00.752.546l4.611.67a1 1 0 01.555 1.705l-3.34 3.26a1 1 0 00-.287.885l.787 4.587a1 1 0 01-1.451 1.054L12 18.347l-4.118 2.165a1 1 0 01-1.451-1.054l.787-4.587a1 1 0 00-.287-.885l-3.34-3.26a1 1 0 01.555-1.705l4.611-.67a1 1 0 00.752-.546l2.065-4.186z" />
                                                    </svg>
                                                @else
                                                    <!-- Empty Star for non-favorited houses -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11.049 2.927a1 1 0 011.902 0l2.065 4.186a1 1 0 00.752.546l4.611.67a1 1 0 01.555 1.705l-3.34 3.26a1 1 0 00-.287.885l.787 4.587a1 1 0 01-1.451 1.054L12 18.347l-4.118 2.165a1 1 0 01-1.451-1.054l.787-4.587a1 1 0 00-.287-.885l-3.34-3.26a1 1 0 01.555-1.705l4.611-.67a1 1 0 00.752-.546l2.065-4.186z" />
                                                    </svg>
                                                @endif
                                            </button>
                                        </form>
                                    @endauth

                                    <img src="{{ $huis->afbeelding ?? 'https://placehold.co/400' }}"
                                        alt="{{ $huis->naam }}" class="w-full h-48 object-cover rounded-t-lg mb-4">
                                    <h3 class="text-xl font-bold text-gray-800">{{ $huis->naam }}</h3>
                                    <p class="text-gray-600">{{ $huis->locatie }}</p>
                                    <p class="text-green-600 font-semibold">€ {{ $huis->prijs }}</p>
                                    <a href="{{ route('huizen.show', $huis->id) }}"
                                        class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                        Bekijk details
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
