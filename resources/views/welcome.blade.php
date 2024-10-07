<x-app-layout>
    <div class="min-h-screen flex flex-col bg-gray-50">
        <!-- Header Component -->
        <x-header />

        <!-- Hero Section -->
        <div class="flex-grow bg-green-100 py-16 relative">
            <!-- Overlay Background Gradient -->
            <div class="absolute inset-0 bg-gradient-to-r from-green-200 to-green-100 opacity-80"></div>

            <div class="container mx-auto text-center relative z-10">
                <!-- Image above the Search Bar -->
                <div class="mb-8">
                    <img src="{{ asset('images/hero-image.png') }}" alt="Vakantiehuis illustratie"
                         class="w-48 lg:w-64 h-auto mx-auto hero-icon">
                </div>

                <!-- Search Bar Section -->
                <div class="bg-white p-8 rounded-2xl shadow-xl inline-block w-full max-w-2xl">
                    <form action="{{ route('huizen.index') }}" method="GET" class="flex items-center space-x-2">
                        <input type="text" name="query" placeholder="Zoek op plaats, buurt of postcode"
                               class="w-full px-6 py-4 border border-gray-300 rounded-l-md focus:outline-none focus:border-green-500">
                        <button type="submit"
                                class="px-8 py-4 bg-green-600 text-white rounded-r-md hover:bg-green-700 transform hover:scale-105 transition ease-in-out duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15.232 15.232l-4.804-4.804A5.5 5.5 0 1118 8.5a5.5 5.5 0 01-1.465 3.732l-4.804 4.804zM10.5 8.5a3.5 3.5 0 100-7 3.5 3.5 0 000 7z" />
                            </svg>
                        </button>
                    </form>
                    <p class="mt-4 text-sm text-gray-600 italic">Laatste zoekopdracht:
                        <a href="{{ route('huizen.index', ['query' => 'Haarlem']) }}"
                           class="text-green-700 font-semibold hover:underline transition duration-300 ease-in-out">
                            Haarlem + 0 filter
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer Component -->
        <x-footer />
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
