import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Initialiseer de kaart zodra de DOM volledig geladen is
document.addEventListener('DOMContentLoaded', function () {
    let map, marker;

    // Controleer of de kaart-element bestaat
    const mapElement = document.getElementById('map');
    if (mapElement) {
        const latitude = parseFloat(document.querySelector("#latitude")?.value || 52.3676);  // Standaard: Amsterdam
        const longitude = parseFloat(document.querySelector("#longitude")?.value || 4.9041);

        // Initialiseer de kaart met de standaard coördinaten
        map = L.map(mapElement).setView([latitude, longitude], 13);

        // Voeg de OpenStreetMap tegel-laag toe
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
    const updateMap = (latitude, longitude) => {
        if (map && latitude && longitude) {
            map.setView([latitude, longitude], 13);
            // Verwijder bestaande marker en voeg een nieuwe toe
            if (marker) map.removeLayer(marker);
            marker = L.marker([latitude, longitude]).addTo(map)
                .bindPopup('Vakantiehuis locatie')
                .openPopup();
        }
    };

    // Functie voor het in-/uitklappen van de zijbalk
    const toggleSidebar = () => {
        const sidebar = document.getElementById('sidebar');
        const showSidebarButton = document.getElementById('showSidebarButton');
        if (sidebar) {
            sidebar.classList.toggle('hidden');
            showSidebarButton?.classList.toggle('hidden', !sidebar.classList.contains('hidden'));
        }
    };

    // Zijbalk toggle event listeners
    document.getElementById('toggleSidebarButton')?.addEventListener('click', toggleSidebar);
    document.getElementById('showSidebarButton')?.addEventListener('click', toggleSidebar);

    // Functie om de prijslabels bij te werken op basis van de sliders
    const updatePriceLabels = () => {
        const minPriceSlider = document.getElementById('min_prijs');
        const maxPriceSlider = document.getElementById('max_prijs');
        const minPriceLabel = document.getElementById('min-prijs-label');
        const maxPriceLabel = document.getElementById('max-prijs-label');

        if (minPriceSlider && maxPriceSlider && minPriceLabel && maxPriceLabel) {
            minPriceSlider.addEventListener('input', () => minPriceLabel.textContent = `€${minPriceSlider.value}`);
            maxPriceSlider.addEventListener('input', () => maxPriceLabel.textContent = `€${maxPriceSlider.value}`);
        }
    };

    updatePriceLabels();
});
