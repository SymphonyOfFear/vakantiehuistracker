<x-app-layout>
    <div class="min-h-screen flex flex-col">

        <div class="flex-grow bg-green-100 py-16">
            <div class="container mx-auto text-center">

                <!-- Hero Image -->
                <div class="mb-8">
                    <img src="{{ asset('images/site/hero-image.png') }}" alt="Vakantiehuis illustratie"
                        class="w-48 lg:w-64 h-auto mx-auto">
                </div>

                <!-- Search Form -->
                <div class="bg-white p-6 rounded-lg inline-block w-full max-w-2xl">
                    <form action="{{ route('huizen.index') }}" method="GET" class="flex items-center relative space-x-2">
                        <div class="w-full relative">
                            <input type="text" id="location" name="zoekopdracht" 
                                placeholder="Zoek op plaats, buurt of postcode"
                                class="w-full px-6 py-4 border border-gray-300 rounded-l-md focus:outline-none focus:border-green-500"
                                value="{{ session('last_search', '') }}">
                        </div>
                        <button type="submit"
                            class="px-8 py-4 bg-green-600 text-white rounded-r-md hover:bg-green-700 transition duration-300">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>

                    <!-- Last Search Link -->
                    <p class="mt-2 text-sm text-gray-500">Laatste zoekopdracht:
                        <a href="{{ session('last_search') ? route('huizen.index', ['zoekopdracht' => session('last_search')]) : '#' }}"
                            class="text-green-600 hover:underline">
                            {{ session('last_search', 'Geen zoekopdracht') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
