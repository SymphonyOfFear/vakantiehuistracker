import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// TomSelect initialization with a check
document.addEventListener('DOMContentLoaded', function () {
    const selectElements = document.querySelectorAll('.select-search');
    if (selectElements.length > 0) {
        new TomSelect('.select-search', {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    }
});

// Toggle Sidebar Functionality
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const toggleButton = document.getElementById('toggleSidebarButton');
    const showSidebarButton = document.getElementById('showSidebarButton');

    if (sidebar.classList.contains('hidden')) {
        sidebar.classList.remove('hidden');
        mainContent.classList.remove('w-full');
        toggleButton.classList.remove('hidden');
        showSidebarButton.classList.add('hidden');
    } else {
        sidebar.classList.add('hidden');
        mainContent.classList.add('w-full');
        toggleButton.classList.add('hidden');
        showSidebarButton.classList.remove('hidden');
    }
}

// Add event listeners for toggle buttons
document.getElementById('toggleSidebarButton').addEventListener('click', toggleSidebar);
document.getElementById('showSidebarButton').addEventListener('click', toggleSidebar);
