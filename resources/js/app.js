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

    // Toggle Sidebar Functionality
    const sidebar = document.getElementById('sidebar');
    const toggleSidebarButton = document.getElementById('toggleSidebarButton');
    const showSidebarButton = document.getElementById('showSidebarButton');

    toggleSidebarButton.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
        toggleSidebarButton.classList.toggle('hidden');
        showSidebarButton.classList.toggle('hidden');
    });

    showSidebarButton.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
        toggleSidebarButton.classList.toggle('hidden');
        showSidebarButton.classList.toggle('hidden');
    });
});
