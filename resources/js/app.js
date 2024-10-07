import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    let map, marker;

    // Function to initialize the map with given coordinates
    const initializeMapWithCoordinates = (latitude, longitude) => {
        map = L.map('map').setView([latitude, longitude], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        marker = L.marker([latitude, longitude]).addTo(map)
            .bindPopup('Vakantiehuis locatie')
            .openPopup();

        marker.on('click', () => {
            const googleMapsUrl = `https://www.google.com/maps?q=${latitude},${longitude}`;
            window.open(googleMapsUrl, '_blank');
        });
    };

    // Function to initialize map based on latitude and longitude from the page
    const initializeMap = () => {
        const mapElement = document.getElementById('map');
        if (mapElement) {
            // Get latitude and longitude from hidden inputs or data attributes
            const latitude = parseFloat(mapElement.getAttribute('data-latitude')) || parseFloat(document.querySelector("#latitude")?.value || null);
            const longitude = parseFloat(mapElement.getAttribute('data-longitude')) || parseFloat(document.querySelector("#longitude")?.value || null);

            // If both latitude and longitude are available, initialize map with coordinates
            if (latitude && longitude) {
                initializeMapWithCoordinates(latitude, longitude);
            } else {
                console.error('Geocoding failed: No valid latitude or longitude found.');
            }
        }
    };

    // Sidebar toggle function
    const toggleSidebar = () => {
        const sidebar = document.getElementById('sidebar');
        const showSidebarButton = document.getElementById('showSidebarButton');
        if (sidebar) {
            sidebar.classList.toggle('hidden');
            showSidebarButton?.classList.toggle('hidden', !sidebar.classList.contains('hidden'));
        }
    };

    document.getElementById('toggleSidebarButton')?.addEventListener('click', toggleSidebar);
    document.getElementById('showSidebarButton')?.addEventListener('click', toggleSidebar);

    // Function to handle location autocomplete using Geonames API
    const handleLocationAutocomplete = () => {
        const locationInput = document.querySelector('#location');
        const suggestionsBox = document.querySelector('#location-suggestions');

        if (locationInput && suggestionsBox) {
            locationInput.addEventListener('input', () => {
                const query = locationInput.value.trim();

                if (query.length > 2) {
                    fetch(`https://secure.geonames.org/searchJSON?name_startsWith=${query}&country=NL&maxRows=5&username=YOUR_USERNAME`)
                        .then(response => response.json())
                        .then(data => {
                            suggestionsBox.innerHTML = '';
                            if (data.geonames && data.geonames.length > 0) {
                                data.geonames.forEach(location => {
                                    const suggestion = document.createElement('div');
                                    suggestion.classList.add('cursor-pointer', 'py-2', 'px-4', 'hover:bg-gray-200');
                                    suggestion.textContent = `${location.name}, ${location.adminName1}`;
                                    suggestion.addEventListener('click', () => {
                                        locationInput.value = suggestion.textContent;
                                        suggestionsBox.innerHTML = '';
                                    });
                                    suggestionsBox.appendChild(suggestion);
                                });
                                suggestionsBox.classList.remove('hidden');
                            } else {
                                suggestionsBox.classList.add('hidden');
                            }
                        })
                        .catch(error => console.error('Error fetching suggestions:', error));
                } else {
                    suggestionsBox.innerHTML = '';
                    suggestionsBox.classList.add('hidden');
                }
            });
        }
    };

    initializeMap(); // Call the modified initializeMap function to load the map based on the vacation house location.
    handleLocationAutocomplete();
});
