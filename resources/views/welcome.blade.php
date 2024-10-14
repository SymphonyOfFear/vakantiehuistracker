<x-app-layout>
    <div class="min-h-screen flex flex-col">
        <!-- Header Component -->
        <x-header />

        <!-- Hero Section -->
        <div class="flex-grow bg-green-100 py-16">
            <div class="container mx-auto text-center">

                <!-- Image above the Search Bar -->
                <div class="mb-8">
                    <img src="{{ asset('images/hero-image.png') }}" alt="Vakantiehuis illustratie"
                        class="w-48 lg:w-64 h-auto mx-auto">
                </div>

                <!-- Search Bar Section -->
                <div class="bg-white p-6 rounded-lg inline-block w-full max-w-2xl">
                    <form action="{{ route('huizen.index') }}" method="GET" class="flex items-center space-x-2">
                        <input type="text" name="query" placeholder="Zoek op plaats, buurt of postcode"
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
                    <p class="mt-2 text-sm text-gray-500">Laatste zoekopdracht:
                        <!-- Dynamic link to last search -->
                        <a href="{{ route('huizen.index', ['query' => 'Haarlem']) }}"
                            class="text-green-600 hover:underline">
                            Haarlem + 0 filter
                        </a>
                    </p>

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
                                @foreach ($huisjes as $huisje)
                                    <div class="bg-white p-4 rounded-lg shadow">
                                        <img src="{{ $huisje->afbeelding ?? 'https://placehold.co/400' }}"
                                            alt="{{ $huisje->naam }}"
                                            class="w-full h-48 object-cover rounded-t-lg mb-4">
                                        <h3 class="text-xl font-bold text-gray-800">{{ $huisje->naam }}</h3>
                                        <p class="text-gray-600">Locatie: {{ $huisje->locatie }}</p>
                                        <p class="text-green-600 font-semibold">€ {{ $huisje->prijs }}</p>
                                        <a href="{{ route('verhuurder.huizen.store ', $huisje->id) }}"
                                            class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                            Bekijk details
                                        </a>                                   
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Component -->
        <x-footer />
    </div>
</x-app-layout>
