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
                    
                </div>
            </div>
        </div>

        <!-- Footer Component -->
        <x-footer />
    </div>
</x-app-layout>
