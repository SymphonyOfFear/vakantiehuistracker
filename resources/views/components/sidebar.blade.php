<!-- Sidebar Component -->
<div id="sidebar" class="bg-gray-100 w-1/4 h-auto shadow-lg p-4 relative">
    <!-- Sidebar Title -->
    <div class="text-lg font-semibold text-gray-800 mb-4 flex justify-between items-center">
        <span>{{ $title ?? 'Menu' }}</span>
        <!-- Cross Icon for Closing Sidebar -->
        <button id="toggleSidebarButton" onclick="toggleSidebar()" class="focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Sidebar Dropdowns -->
    <ul class="space-y-4">
        <!-- Dashboard Link -->
        <li><a href="{{ route('verhuurder.dashboard') }}"
                class="{{ Request::is('verhuurder/dashboard*') ? 'text-green-600 font-bold' : 'text-gray-700' }} hover:text-green-600">
                Dashboard</a></li>

        <!-- Verhuurder Huizen Dropdown -->
        <li x-data="{ open: false }">
            <a @click="open = !open"
                class="cursor-pointer {{ Request::is('verhuurder/huizen*') ? 'text-green-600 font-bold' : 'text-gray-700' }} hover:text-green-600">Huizenbeheer</a>
            <ul x-show="open" class="pl-4 mt-2 space-y-2">
                <li><a href="{{ route('verhuurder.huizen.index') }}"
                        class="{{ Request::is('verhuurder/huizen/index') ? 'text-green-600 font-bold' : 'text-gray-600' }} hover:text-green-600">
                        Alle Huizen</a></li>
                <li><a href="{{ route('verhuurder.huizen.create') }}"
                        class="{{ Request::is('verhuurder/huizen/create') ? 'text-green-600 font-bold' : 'text-gray-600' }} hover:text-green-600">
                        Voeg Huis Toe</a></li>
            </ul>
        </li>




        <!-- Recensies Dropdown -->
        <li><a href="{{ route('recensies.index') }}"
                class="{{ Request::is('recensies*') ? 'text-green-600 font-bold' : 'text-gray-700' }} hover:text-green-600">Recensies</a>
        </li>
        <li> <a href="{{ route('reserveringen.index') }}"
                class="{{ Request::is('reserveringen*') ? 'text-green-600 font-bold' : 'text-gray-700' }} hover:text-green-600">Reserveringen</a>
        </li>

        <!-- Favorieten Link -->
        <li><a href="{{ route('favorieten.index') }}"
                class="{{ Request::is('favorieten*') ? 'text-green-600 font-bold' : 'text-gray-700' }} hover:text-green-600">Favorieten</a>
        </li>
    </ul>
</div>

<!-- Sidebar Toggle Button -->
<div class="mt-5 left-2 z-50">
    <button id="showSidebarButton" class="hidden bg-green-500 text-white p-2 rounded-full focus:outline-none "
        onclick="toggleSidebar()">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 6h18M3 18h18" />
        </svg>
    </button>
</div>
