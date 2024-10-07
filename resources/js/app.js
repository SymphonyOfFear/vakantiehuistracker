import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    let map, marker;

    // Function to initialize the map with given coordinates
    const initializeMapWithCoordinates = (latitude, longitude) => {
        if (map) {
            map.remove(); // Reset the map if it already exists
        }
        map = L.map('map').setView([latitude, longitude], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
        }).addTo(map);

        marker = L.marker([latitude, longitude]).addTo(map)
            .bindPopup('Vakantiehuis locatie')
            .openPopup();

        marker.on('click', () => {
            const googleMapsUrl = `https://www.google.com/maps?q=${latitude},${longitude}`;
            window.open(googleMapsUrl, '_blank');
        });
    };

    // Function to initialize the map from element attributes
    const initializeMap = () => {
        const mapElement = document.getElementById('map');
        if (mapElement) {
            const latitude = parseFloat(mapElement.getAttribute('data-latitude')) || 52.3676; // Default: Amsterdam
            const longitude = parseFloat(mapElement.getAttribute('data-longitude')) || 4.9041;
            initializeMapWithCoordinates(latitude, longitude);
        }
    };

    // Function to handle city autocomplete using the Geonames API
    const handleCityAutocomplete = () => {
        const cityInput = document.querySelector('#stad');
        const citySuggestionsBox = document.querySelector('#stad-suggestions');

        if (cityInput && citySuggestionsBox) {
            cityInput.addEventListener('input', () => {
                const query = cityInput.value.trim();

                if (query.length > 2) {
                    fetch(`https://secure.geonames.org/searchJSON?name_startsWith=${query}&country=NL&maxRows=5&username=Keiji`)
                        .then(response => response.json())
                        .then(data => {
                            citySuggestionsBox.innerHTML = '';
                            if (data.geonames && data.geonames.length > 0) {
                                data.geonames.forEach(city => {
                                    const suggestion = document.createElement('div');
                                    suggestion.classList.add('cursor-pointer', 'py-2', 'px-4', 'hover:bg-gray-200');
                                    suggestion.textContent = `${city.name}, ${city.adminName1}`;
                                    suggestion.addEventListener('click', () => {
                                        cityInput.value = suggestion.textContent;
                                        citySuggestionsBox.innerHTML = '';

                                        // Update the map based on the selected city
                                        const selectedLat = parseFloat(city.lat);
                                        const selectedLon = parseFloat(city.lng || city.lon);
                                        updateMap(selectedLat, selectedLon);
                                    });
                                    citySuggestionsBox.appendChild(suggestion);
                                });
                                citySuggestionsBox.classList.remove('hidden');
                            } else {
                                citySuggestionsBox.classList.add('hidden');
                            }
                        })
                        .catch(error => console.error('Error fetching suggestions:', error));
                } else {
                    citySuggestionsBox.innerHTML = '';
                    citySuggestionsBox.classList.add('hidden');
                }
            });
        }
    };

    // Function to handle favorite button toggling
    const handleFavoriteButtons = () => {
        const favoriteButtons = document.querySelectorAll('.favorite-button');
        favoriteButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const url = button.getAttribute('href');

                fetch(url, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            button.querySelector('i').classList.toggle('text-red-600');
                            button.querySelector('i').classList.toggle('text-black');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    };

    // Function to handle star rating functionality
    const handleStarRating = () => {
        const stars = document.querySelectorAll('#star-rating .fa-star');
        let selectedRating = parseInt(document.querySelector('#star-rating').dataset.userRating) || 0;

        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                selectedRating = index + 1;
                stars.forEach((s, i) => {
                    s.classList.toggle('text-yellow-500', i < selectedRating);
                    s.classList.toggle('text-gray-300', i >= selectedRating);
                });

                // Save the selected rating using a POST request
                const ratingUrl = star.dataset.url;
                fetch(ratingUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ rating: selectedRating })
                }).then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Rating opgeslagen!');
                        } else {
                            alert('Er is iets misgegaan.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
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

    // Function to update price labels based on range slider
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

    // Initialize all functions
    initializeMap(); // Initialize map on load
    updatePriceLabels(); // Initialize price labels
    handleCityAutocomplete(); // Initialize city autocomplete
    handleFavoriteButtons(); // Initialize favorite button functionality
    handleStarRating(); // Initialize star rating functionality

    // Sidebar toggle event listeners
    document.getElementById('toggleSidebarButton')?.addEventListener('click', toggleSidebar);
    document.getElementById('showSidebarButton')?.addEventListener('click', toggleSidebar);
});
