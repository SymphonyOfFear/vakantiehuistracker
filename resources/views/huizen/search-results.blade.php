<x-app-layout>
    <div class="min-h-screen flex flex-col">
        <!-- Header Component -->
        <x-header />

        <!-- Search Results Section -->
        <div class="flex-grow bg-gray-100 py-10">
            <div class="container mx-auto">
                <h2 class="text-3xl font-semibold text-gray-700 mb-6">Zoekresultaten voor "{{ $query }}"</h2>

                <!-- Search Bar Section -->
                <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                    <form action="{{ route('huizen.search') }}" method="GET" class="flex items-center space-x-2">
                        <input type="text" name="query" placeholder="Zoek op plaats, buurt of postcode"
                            value="{{ $query }}"
                            class="w-full px-6 py-4 border border-gray-300 rounded-l-md focus:outline-none focus:border-green-500">
                        <button type="submit"
                            class="px-8 py-4 bg-green-600 text-white rounded-r-md hover:bg-green-700 transition ease-in-out duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.232 15.232l-4.804-4.804A5.5 5.5 0 1118 8.5a5.5 5.5 0 01-1.465 3.732l-4.804 4.804zM10.5 8.5a3.5 3.5 0 100-7 3.5 3.5 0 000 7z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Results Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($huizen as $huis)
                        <div class="bg-white p-4 rounded-lg shadow">
                            <img src="{{ asset('images/' . $huis->image) }}" alt="{{ $huis->name }}"
                                class="w-full h-48 object-cover rounded-t-lg mb-4">
                            <h3 class="text-xl font-bold text-gray-800">{{ $huis->name }}</h3>
                            <p class="text-gray-600">{{ $huis->location }}</p>
                            <p class="text-green-600 font-semibold">{{ $huis->price }}</p>
                        </div>
                    @empty
                        <p class="text-gray-700 text-lg">Geen resultaten gevonden voor "{{ $query }}".</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Footer Component -->
        <x-footer />
    </div>
</x-app-layout>
