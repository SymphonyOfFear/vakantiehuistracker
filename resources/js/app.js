import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
document.querySelector('button[aria-haspopup]').addEventListener('click', function () {
    this.nextElementSibling.classList.toggle('hidden');
});

document.addEventListener('DOMContentLoaded', function () {
    new TomSelect('.select-search', {
        create: false,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
});