import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Initialiseer de kaart zodra de DOM volledig geladen is
document.addEventListener('DOMContentLoaded', function () {
    let map;
    let marker;

    if (document.getElementById('map')) {
        const latitude = document.querySelector("#latitude").value || 52.3676;
        const longitude = document.querySelector("#longitude").value || 4.9041;

        // Kaart starten met standaardcoördinaten (Amsterdam)
        map = L.map('map').setView([latitude, longitude], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Voeg een marker toe als latitude en longitude aanwezig zijn
        if (latitude && longitude) {
            marker = L.marker([latitude, longitude]).addTo(map)
                .bindPopup('Vakantiehuis locatie')
                .openPopup();
        }
    }

    // Functie om de kaart en marker bij te werken
    function updateMap(latitude, longitude) {
        if (map && latitude && longitude) {
            map.setView([latitude, longitude], 13);

            // Verwijder bestaande marker en voeg een nieuwe toe
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker([latitude, longitude]).addTo(map)
                .bindPopup('Vakantiehuis locatie')
                .openPopup();
        }
    }

    // Functie voor het in-/uitklappen van de zijbalk
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden');
        const showSidebarButton = document.getElementById('showSidebarButton');
        if (sidebar.classList.contains('hidden')) {
            showSidebarButton.classList.remove('hidden');
        } else {
            showSidebarButton.classList.add('hidden');
        }
    }

    // Zijbalk toggle event listeners
    const toggleButton = document.getElementById('toggleSidebarButton');
    const showButton = document.getElementById('showSidebarButton');

    if (toggleButton) {
        toggleButton.addEventListener('click', toggleSidebar);
    }
    if (showButton) {
        showButton.addEventListener('click', toggleSidebar);
    }

    // Functie om de prijslabels bij te werken op basis van de sliders
    const minPriceSlider = document.getElementById('min_prijs');
    const maxPriceSlider = document.getElementById('max_prijs');
    const minPriceLabel = document.getElementById('min-prijs-label');
    const maxPriceLabel = document.getElementById('max-prijs-label');

    if (minPriceSlider && maxPriceSlider) {
        minPriceSlider.addEventListener('input', function () {
            minPriceLabel.textContent = `€${minPriceSlider.value}`;
        });

        maxPriceSlider.addEventListener('input', function () {
            maxPriceLabel.textContent = `€${maxPriceSlider.value}`;
        });
    }
});
