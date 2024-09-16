import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


document.addEventListener('DOMContentLoaded', function () {
    new TomSelect('.select-search', {
        create: false,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
});