<!-- Sidebar Component -->
<div id="sidebar" class="bg-gray-100 w-1/4 h-screen shadow-lg p-4">
    <!-- Sidebar Title -->
    <div class="text-lg font-semibold text-gray-800 mb-4 flex justify-between items-center">
        <span>{{ $title ?? 'Menu' }}</span>
        <!-- Cross Icon for Closing Sidebar -->
        <button onclick="toggleSidebar()" class="focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Sidebar Items -->
    <ul class="space-y-4">
        {{ $slot }}
    </ul>
</div>
