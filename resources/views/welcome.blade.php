<x-app-layout>
    <div class="min-h-screen flex flex-col">

        <div class="flex-grow bg-green-100 py-16">
            <div class="container mx-auto text-center">

                <div class="mb-8">
                    <img src="{{ asset('images/hero-image.png') }}" alt="Vakantiehuis illustratie"
                        class="w-48 lg:w-64 h-auto mx-auto">
                </div>


                <div class="bg-white p-6 rounded-lg inline-block w-full max-w-2xl">
                    <form action="{{ route('huizen.index') }}" method="GET"
                        class="flex items-center space-x-2 relative">
                        <div class="w-full relative">

                            <input type="text" id="location" name="query"
                                placeholder="Zoek op plaats, buurt of postcode"
                                class="w-full px-6 py-4 border border-gray-300 rounded-l-md focus:outline-none focus:border-green-500">

                            <div id="location-suggestions"
                                class="absolute z-10 w-full bg-white shadow-lg border border-gray-200 mt-1 rounded-md max-h-60 overflow-y-auto hidden">
                            </div>
                        </div>

                        <button type="submit"
                            class="px-8 py-4 bg-green-600 text-white rounded-r-md hover:bg-green-700 transition ease-in-out duration-300">
                            <i class="fas fa-map-marker-alt"></i>
                        </button>
                    </form>
                    <p class="mt-2 text-sm text-gray-500">Laatste zoekopdracht:
                        <a href="{{ session('last_search') ? route('huizen.index', ['query' => session('last_search')]) : '#' }}"
                            class="text-green-600 hover:underline">
                            {{ session('last_search', 'Geen zoekopdracht') }} + 0 filter
                        </a>
                    </p>
                </div>
            </div>
        </div>



    </div>

    <style>
        /* Custom CSS for the hero image */
        .hero-icon {
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
            transition: transform 0.3s ease;
        }

        .hero-icon:hover {
            transform: scale(1.05);
        }
    </style>
</x-app-layout>
