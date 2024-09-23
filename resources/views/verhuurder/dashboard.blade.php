<x-app-layout>
    <x-header />

    <div class="flex flex-col min-h-screen">
        <!-- Sidebar Toggle Button -->
        <div class="flex justify-between items-center p-6 bg-green-500">
            <h1 class="text-2xl font-bold text-white">Welkom bij het Verhuurder Dashboard</h1>
            <div>
                <button id="toggleSidebarButton" class="bg-green-600 text-white px-4 py-2 rounded"
                    onclick="toggleSidebar()">
                    Verberg Sidebar
                </button>
                <button id="showSidebarButton" class="hidden bg-green-600 text-white px-4 py-2 rounded"
                    onclick="toggleSidebar()">
                    Toon Sidebar
                </button>
            </div>
        </div>

        <div class="flex flex-grow">
            <!-- Sidebar Component -->
            <x-sidebar id="sidebar" class="w-64 h-full">
                <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                        Huizen</a></li>
                <li><a href="{{ route('reserveringen.index') }}"
                        class="text-gray-700 hover:text-green-600">Reserveringen</a></li>
            </x-sidebar>

            <!-- Main Content -->
            <div id="mainContent" class="flex-grow p-6 bg-white">
                <h1 class="text-2xl font-bold">Beheer Uw Vakantiehuizen</h1>
                <p>Hier kunt u uw vakantiehuizen beheren en reserveringen bekijken.</p>
            </div>
        </div>

        <!-- Footer Component -->
        <x-footer class="bg-gray-900 text-white p-4" />
    </div>
</x-app-layout>
