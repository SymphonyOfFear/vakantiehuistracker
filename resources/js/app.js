import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    let map, marker;

    // Initialiseer de kaart met de opgegeven coördinaten
    const initializeMapWithCoordinates = (latitude, longitude) => {
        if (map) {
            map.remove(); // Reset de kaart als deze al bestaat
        }
        map = L.map('map').setView([latitude, longitude], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
        }).addTo(map);
        marker = L.marker([latitude, longitude]).addTo(map).bindPopup('Vakantiehuis locatie').openPopup();

        // Open de locatie in Google Maps bij een klik op de marker
        marker.on('click', () => {
            const googleMapsUrl = `https://www.google.com/maps?q=${latitude},${longitude}`;
            window.open(googleMapsUrl, '_blank');
        });
    };

    // Initialiseer de kaart op basis van data-attributen in de HTML
    const initializeMap = () => {
        const mapElement = document.getElementById('map');
        if (mapElement) {
            const postalCode = mapElement.getAttribute('data-postcode');
            if (postalCode) {
                getCoordinatesByPostalCode(postalCode).then(({ latitude, longitude }) => {
                    initializeMapWithCoordinates(latitude, longitude);
                });
            } else {
                initializeMapWithCoordinates(52.3676, 4.9041); // Standaard locatie: Amsterdam
            }
        }
    };

    // Haal de coördinaten op op basis van de opgegeven postcode
    const getCoordinatesByPostalCode = (postalCode) => {
        const geocodeServiceUrl = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(postalCode)}&countrycodes=NL`;
        return fetch(geocodeServiceUrl)
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    const location = data[0];
                    return {
                        latitude: parseFloat(location.lat),
                        longitude: parseFloat(location.lon),
                    };
                } else {
                    throw new Error('Ongeldige postcode of locatie niet gevonden.');
                }
            })
            .catch(error => {
                console.error('Fout bij het ophalen van coördinaten:', error);
                return { latitude: 52.3676, longitude: 4.9041 }; // Standaard locatie: Amsterdam
            });
    };

    // Behandel de functionaliteit voor het toevoegen en verwijderen van favorieten
    const handleFavoriteButtons = () => {
        const favoriteForms = document.querySelectorAll('.favorite-form');
        favoriteForms.forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const id = form.getAttribute('data-id');
                const url = `/favorieten/toggle/${id}`;
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                })
                    .then(response => {
                        if (response.ok) {
                            location.reload(); // Herlaad de pagina na het wijzigen van de favorietstatus
                        } else {
                            alert('Er is een fout opgetreden.');
                        }
                    })
                    .catch(error => console.error('Fout:', error));
            });
        });
    };

    // Behandel de autocomplete functionaliteit voor stadsnamen
    const handleCityAutocomplete = () => {
        const cityInputs = document.querySelectorAll('#stad, #location');
        const citySuggestionsBoxes = document.querySelectorAll('#stad-suggestions, #location-suggestions');

        if (cityInputs.length === 0 || citySuggestionsBoxes.length === 0) {
            console.error("Stadsinput of suggestie-elementen niet gevonden!");
            return;
        }

        cityInputs.forEach((cityInput, index) => {
            const citySuggestionsBox = citySuggestionsBoxes[index];

            if (!citySuggestionsBox) {
                console.error("Suggestiebox niet gevonden voor input:", cityInput.id);
                return;
            }

            cityInput.addEventListener('input', () => {
                const query = cityInput.value.trim();

                if (query.length > 2) {
                    fetch(`https://secure.geonames.org/searchJSON?name_startsWith=${query}&country=NL&maxRows=5&username=Keiji`)
                        .then(response => response.json())
                        .then(data => {
                            if (!citySuggestionsBox) return;

                            citySuggestionsBox.innerHTML = ''; // Wis vorige suggesties

                            if (data.geonames && data.geonames.length > 0) {
                                data.geonames.forEach(city => {
                                    const suggestion = document.createElement('div');
                                    suggestion.classList.add('cursor-pointer', 'py-2', 'px-4', 'hover:bg-gray-200');
                                    suggestion.textContent = `${city.name}, ${city.adminName1}`;

                                    // Voeg klikgebeurtenis toe om input te vullen met geselecteerde suggestie
                                    suggestion.addEventListener('click', () => {
                                        cityInput.value = suggestion.textContent;
                                        citySuggestionsBox.innerHTML = ''; // Wis suggesties na selectie

                                        // Update de kaart met de coördinaten van de geselecteerde stad
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
                        .catch(error => {
                            console.error('Fout bij het ophalen van suggesties:', error);
                        });
                } else {
                    citySuggestionsBox.innerHTML = ''; // Wis suggesties bij ongeldige invoer
                    citySuggestionsBox.classList.add('hidden');
                }
            });
        });
    };

    // Toon previews van de nieuwe afbeeldingen bij het uploaden
    const previewNewImages = (event) => {
        const previewsContainer = document.getElementById('new-image-previews');
        if (!previewsContainer) return;

        previewsContainer.innerHTML = ''; // Wis vorige previews

        Array.from(event.target.files).forEach(file => {
            const img = document.createElement('img');
            img.classList.add('w-full', 'h-32', 'object-cover', 'rounded');
            img.src = URL.createObjectURL(file);

            // Bevrijd geheugen na het laden van de afbeelding
            img.onload = () => URL.revokeObjectURL(img.src);
            previewsContainer.appendChild(img);
        });
    };

    // Verwerk verwijdering van afbeeldingen
   // Verwerk verwijdering van afbeeldingen
const handleImageDeletion = () => {
    const deleteButtons = document.querySelectorAll('.delete-image-button');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const imageElement = button.closest('.relative').querySelector('img');
            if (!imageElement) return;

            const imageId = button.getAttribute('data-image-id'); // Haal de ID van de afbeelding op
            const url = `/verhuurder/huizen/afbeeldingen/${imageId}`; // Verwijderings-URL in de controller

            // Stuur een DELETE-verzoek naar de Laravel-controller
            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
            })
                .then(response => {
                    if (response.ok) {
                        button.closest('.relative').remove(); // Verwijder de afbeelding uit de DOM
                    } else {
                        console.error('Fout bij het verwijderen van de afbeelding.');
                    }
                })
                .catch(error => console.error('Fout bij het verwijderen van de afbeelding:', error));
        });
    });
};


    // min max sliders
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

    // Zoekfunctie
    const initializeWelcomePageSearch = () => {
        const locationInput = document.getElementById('location');
        const locationSuggestionsBox = document.getElementById('location-suggestions');
        if (!locationInput || !locationSuggestionsBox) return;

        locationInput.addEventListener('input', () => {
            const query = locationInput.value.trim();
            if (query.length > 2) {
                fetch(`https://secure.geonames.org/searchJSON?name_startsWith=${query}&country=NL&maxRows=5&username=Keiji`)
                    .then(response => response.json())
                    .then(data => {
                        locationSuggestionsBox.innerHTML = ''; // Suggesties weghalen
                        if (data.geonames && data.geonames.length > 0) {
                            data.geonames.forEach(city => {
                                const suggestion = document.createElement('div');
                                suggestion.classList.add('cursor-pointer', 'py-2', 'px-4', 'hover:bg-gray-200');
                                suggestion.textContent = `${city.name}, ${city.adminName1}`;

                                suggestion.addEventListener('click', () => {
                                    locationInput.value = suggestion.textContent;
                                    locationSuggestionsBox.innerHTML = ''; // Suggesties weghalen
                                });

                                locationSuggestionsBox.appendChild(suggestion);
                            });
                            locationSuggestionsBox.classList.remove('hidden');
                        } else {
                            locationSuggestionsBox.classList.add('hidden');
                        }
                    })
                    .catch(error => console.error('Fout bij het ophalen van suggesties:', error));
            } else {
                locationSuggestionsBox.innerHTML = ''; // Niet nodige resultaten wissen
                locationSuggestionsBox.classList.add('hidden');
            }
        });
    };

    // Checken of de functie op de pagina kan worden gebruikt zo niet gebruikt die hem niet zodat er geen foutmelding komt te staan
    if (typeof handleImageDeletion === 'function') handleImageDeletion();
    if (typeof initializeMap === 'function') initializeMap();
    if (typeof handleFavoriteButtons === 'function') handleFavoriteButtons();
    if (typeof handleCityAutocomplete === 'function') handleCityAutocomplete();
    if (typeof updatePriceLabels === 'function') updatePriceLabels();
    if (document.getElementById('location')) {
        initializeWelcomePageSearch();
    }
});
