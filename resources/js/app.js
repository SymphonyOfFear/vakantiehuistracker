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

    // Function to initialize the map based on data in HTML elements
    const initializeMap = () => {
        const mapElement = document.getElementById('map');
        if (mapElement) {
            const postalCode = mapElement.getAttribute('data-postcode');
            if (postalCode) {
                getCoordinatesByPostalCode(postalCode).then(({ latitude, longitude }) => {
                    initializeMapWithCoordinates(latitude, longitude);
                });
            } else {
                initializeMapWithCoordinates(52.3676, 4.9041); // Default location Amsterdam
            }
        }
    };

    // Function to fetch coordinates based on a postal code
    const getCoordinatesByPostalCode = (postalCode) => {
        const geocodeServiceUrl = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(postalCode)}&countrycodes=NL`;
        return fetch(geocodeServiceUrl)
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    const location = data[0];
                    return { latitude: parseFloat(location.lat), longitude: parseFloat(location.lon) };
                } else {
                    throw new Error('Ongeldige postcode of locatie niet gevonden.');
                }
            })
            .catch(error => {
                console.error('Fout bij het ophalen van coördinaten:', error);
                return { latitude: 52.3676, longitude: 4.9041 }; // Default location (Amsterdam)
            });
    };

    // Function to handle favorite toggling
    const handleFavoriteButtons = () => {
        const favoriteForms = document.querySelectorAll('.favorite-form');
        favoriteForms.forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault(); // Prevent the default form submission

                const id = form.getAttribute('data-id');
                const url = `/favorieten/toggle/${id}`;

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                })
                    .then(response => {
                        if (response.ok) {
                            location.reload(); // Refresh the page after toggling the favorite status
                        } else {
                            alert('Er is een fout opgetreden.');
                        }
                    })
                    .catch(error => console.error('Fout:', error));
            });
        });
    };

    // Function to handle city and address autocomplete
    const handleCityAutocomplete = () => {
        const cityInputs = document.querySelectorAll('#stad, #location');
        const citySuggestionsBoxes = document.querySelectorAll('#stad-suggestions, #location-suggestions');

        cityInputs.forEach((cityInput, index) => {
            const citySuggestionsBox = citySuggestionsBoxes[index];
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

                                        // Update the map with the selected city
                                        const selectedLat = parseFloat(city.lat);
                                        const selectedLon = parseFloat(city.lng || city.lon);
                                        initializeMapWithCoordinates(selectedLat, selectedLon);
                                    });
                                    citySuggestionsBox.appendChild(suggestion);
                                });
                                citySuggestionsBox.classList.remove('hidden');
                            } else {
                                citySuggestionsBox.classList.add('hidden');
                            }
                        })
                        .catch(error => console.error('Fout bij het ophalen van suggesties:', error));
                } else {
                    citySuggestionsBox.innerHTML = '';
                    citySuggestionsBox.classList.add('hidden');
                }
            });
        });
    };

    const handleImageDeletion = () => {
        const deleteButtons = document.querySelectorAll('.delete-image-button');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault(); // Prevent the default action
                const imageUrl = button.closest('.relative').querySelector('img').src;

                // Mark the hidden input to indicate the image should be deleted
                const hiddenInput = document.querySelector(`#deleted_foto_${button.dataset.imageId}`);
                if (hiddenInput) {
                    hiddenInput.value = imageUrl; // Set the URL for deletion
                    console.log("Hidden input value set for deletion: ", hiddenInput.value); // Debugging
                }

                // Remove the image preview element
                button.closest('.relative').remove();
                console.log("Image preview removed for image URL: ", imageUrl); // Debugging
            });
        });
    };






    // Function to update price labels with the range of the slider
    const updatePriceLabels = () => {
        const minPriceSlider = document.getElementById('min_prijs');
        const maxPriceSlider = document.getElementById('max_prijs');
        const minPriceLabel = document.getElementById('min-prijs-label');
        const maxPriceLabel = document.getElementById('max-prijs-label');

        if (minPriceSlider && maxPriceSlider && minPriceLabel && maxPriceLabel) {
            minPriceSlider.addEventListener('input', () => {
                minPriceLabel.textContent = `€${minPriceSlider.value}`;
                maxPriceSlider.min = minPriceSlider.value;
            });
            maxPriceSlider.addEventListener('input', () => {
                maxPriceLabel.textContent = `€${maxPriceSlider.value}`;
                minPriceSlider.max = maxPriceSlider.value;
            });
        }
    };

    // Initialize all functions if they exist
    if (typeof handleImageDeletion === 'function') { handleImageDeletion(); }
    if (typeof initializeMap === 'function') { initializeMap(); }
    if (typeof handleFavoriteButtons === 'function') { handleFavoriteButtons(); }
    if (typeof handleCityAutocomplete === 'function') { handleCityAutocomplete(); }
    if (typeof handleStarRating === 'function') { handleStarRating(); }
    if (typeof updatePriceLabels === 'function') { updatePriceLabels(); }
});
