import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Initialiseer de kaart zodra de DOM volledig geladen is
document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('map')) {
        const latitude = document.querySelector("#latitude").value;
        const longitude = document.querySelector("#longitude").value;

        // Kaart starten met standaardcoördinaten (Amsterdam)
        var map = L.map('map').setView([latitude || 52.3676, longitude || 4.9041], 13); // Standaard naar Amsterdam

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        if (latitude && longitude) {
            L.marker([latitude, longitude]).addTo(map)
                .bindPopup('Vakantiehuis locatie')
                .openPopup();
        }
    }
});

// Automatisch de breedte- en lengtegraad berekenen op basis van het adres en de stad en straatnaam automatisch invullen
document.getElementById('postcode')?.addEventListener('blur', function () {
    const postcode = document.getElementById('postcode').value;
    const huisnummer = document.getElementById('huisnummer').value;

    if (postcode && huisnummer) {
        const query = `${huisnummer} ${postcode} Netherlands`;
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    const latitude = data[0].lat;
                    const longitude = data[0].lon;
                    const addressDetails = data[0].display_name.split(',');

                    // Vul de straatnaam en stad automatisch in
                    document.getElementById('latitude').value = latitude;
                    document.getElementById('longitude').value = longitude;

                    document.getElementById('straatnaam').value = addressDetails[0].trim();  // Straatnaam
                    document.getElementById('stad').value = addressDetails[addressDetails.length - 3].trim();  // Stad

                    console.log('Coördinaten:', latitude, longitude);

                    // Update de kaart met de nieuwe locatie
                    if (document.getElementById('map')) {
                        var map = L.map('map').setView([latitude, longitude], 13);
                        L.marker([latitude, longitude]).addTo(map)
                            .bindPopup('Vakantiehuis locatie')
                            .openPopup();
                    }
                } else {
                    alert('Adres niet gevonden');
                }
            }).catch(error => {
                console.error('Fout bij het ophalen van de locatie:', error);
                alert('Er ging iets mis bij het ophalen van de locatie.');
            });
    } else {
        alert('Vul alstublieft het huisnummer en de postcode in');
    }
});

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

document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('toggleSidebarButton');
    const showButton = document.getElementById('showSidebarButton');

    if (toggleButton) {
        toggleButton.addEventListener('click', toggleSidebar);
    }
    if (showButton) {
        showButton.addEventListener('click', toggleSidebar);
    }
});

// Functie om breedte- en lengtegraad te berekenen op basis van het adres
document.getElementById('calculateLatLng').addEventListener('click', function (e) {
    e.preventDefault();

    const address = document.getElementById('straatnaam').value;
    const postcode = document.getElementById('postcode').value;
    const huisnummer = document.getElementById('huisnummer').value;

    if (address && postcode && huisnummer) {
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${address}+${huisnummer}+${postcode}+Netherlands`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    const latitude = data[0].lat;
                    const longitude = data[0].lon;

                    document.getElementById('latitude').value = latitude;
                    document.getElementById('longitude').value = longitude;

                    console.log('Coördinaten:', latitude, longitude);
                } else {
                    alert('Adres niet gevonden');
                }
            });
    } else {
        alert('Vul alstublieft alle velden in');
    }
});
