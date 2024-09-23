<x-app-layout>
    <x-header />

    <div class="flex">
        <!-- Sidebar -->
        <div id="sidebar" class="w-1/4 bg-gray-100 h-screen shadow-lg">
            <!-- Sidebar Title -->
            <div class="text-lg font-semibold text-gray-800 mb-4 p-4">
                Menu
            </div>

            <!-- Sidebar Items -->
            <ul class="space-y-4 px-4">
                <li>
                    <a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">
                        Mijn Huizen
                    </a>
                </li>
                <li>
                    <a href="{{ route('reserveringen.index') }}" class="text-gray-700 hover:text-green-600">
                        Reserveringen
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="w-full p-6 bg-white">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">Welkom bij het Verhuurder Dashboard</h1>

                <!-- Toggle Sidebar Button (shown when sidebar is visible) -->
                <button id="toggleSidebarButton" class="bg-green-500 text-white px-4 py-2 rounded">
                    Verberg Sidebar
                </button>

                <!-- Show Sidebar Button (hidden when sidebar is visible) -->
                <button id="showSidebarButton" class="bg-green-500 text-white px-4 py-2 rounded hidden">
                    Toon Sidebar
                </button>
            </div>

            <p class="mt-4">
                Hier kunt u uw vakantiehuizen beheren en reserveringen bekijken.
            </p>
        </div>
    </div>

    <x-footer />
</x-app-layout>
