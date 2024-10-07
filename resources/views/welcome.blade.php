<!-- welcome.blade.php -->
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
                    <form action="{{ route('huizen.index') }}" method="GET"
                        class="flex items-center space-x-2 relative">
                        <div class="w-full relative">
                            <!-- Input field with autocomplete functionality -->
                            <input type="text" id="location" name="query"
                                placeholder="Zoek op plaats, buurt of postcode"
                                class="w-full px-6 py-4 border border-gray-300 rounded-l-md focus:outline-none focus:border-green-500">
                            <!-- Suggestion box for locations -->
                            <div id="location-suggestions"
                                class="absolute z-10 w-full bg-white shadow-lg border border-gray-200 mt-1 rounded-md max-h-60 overflow-y-auto hidden">
                            </div>
                        </div>
                        <!-- Updated button with FontAwesome or SVG Icon -->
                        <button type="submit"
                            class="px-8 py-4 bg-green-600 text-white rounded-r-md hover:bg-green-700 transition ease-in-out duration-300">
                            <!-- Location Pin SVG Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 2C8.134 2 5 5.134 5 9c0 5.166 7 13 7 13s7-7.834 7-13c0-3.866-3.134-7-7-7zM12 11.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
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
