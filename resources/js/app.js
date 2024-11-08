import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    
    

    let kaart;

    // Initialiseer de kaart met de gegeven latitude en longitude
    const initKaart = (lat, lon) => {
        const kaartElement = document.getElementById('map');
        if (!kaartElement) return;
        if (kaart) kaart.remove();
        kaart = L.map(kaartElement).setView([lat, lon], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
        }).addTo(kaart);
        L.marker([lat, lon]).addTo(kaart).bindPopup('Vakantiehuis locatie').openPopup();
    };

    // Controleer of de kaart element bestaat, en initialiseert met opgeslagen coördinaten
    if (document.getElementById('map')) {
        const lat = document.getElementById('map').getAttribute('data-lat');
        const lon = document.getElementById('map').getAttribute('data-lon');
        if (lat && lon) {
            initKaart(parseFloat(lat), parseFloat(lon));
        } else {
            console.error('Latitude of Longitude ontbreekt of is ongeldig.');
        }
    }

    // Functie om coördinaten op te halen op basis van een postcode
    const haalCoordinaten = (postcode) => {
        const geocodeUrl = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(postcode)}&countrycodes=NL`;
        return fetch(geocodeUrl)
            .then((res) => res.json())
            .then((data) => {
                if (data && data.length > 0) {
                    return { lat: parseFloat(data[0].lat), lon: parseFloat(data[0].lon) };
                } else {
                    throw new Error('Ongeldige postcode of locatie niet gevonden.');
                }
            })
            .catch(() => ({ lat: 52.3676, lon: 4.9041 }));
    };

    // Functie om de kaart in te stellen met standaardcoördinaten
    const instelKaart = () => {
        const latField = document.getElementById('latitude');
        const lonField = document.getElementById('longitude');

        if (latField && lonField) {
            let lat = parseFloat(latField.value) || 52.3676;
            let lon = parseFloat(lonField.value) || 4.9041;
            initKaart(lat, lon);
        }
    };

    // Functie om favorieten toe te voegen of te verwijderen
    const beheerFavorieten = () => {
        document.querySelectorAll('.favoriet-form').forEach((form) => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const id = form.getAttribute('data-id');
                fetch(`/favorieten/toggle/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        Accept: 'application/json',
                    },
                })
                    .then((res) => (res.ok ? location.reload() : alert('Er is een fout opgetreden.')))
                    .catch((err) => console.error('Fout:', err));
            });
        });
    };

    // Functie voor autocomplete van de stad en straat
    const instelAutocomplete = (invoerId, suggestieId, zoekType, callback) => {
        const invoer = document.getElementById(invoerId);
        const suggestieBox = document.getElementById(suggestieId);

        if (!invoer || !suggestieBox) return;

        invoer.addEventListener('input', () => {
            const zoekterm = invoer.value.trim();
            if (zoekterm.length > 2) {
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(zoekterm)}&${zoekType}&countrycodes=NL`)
                    .then((res) => res.json())
                    .then((data) => {
                        suggestieBox.innerHTML = '';
                        if (data.length > 0) {
                            data.forEach((locatie) => {
                                const suggestie = document.createElement('div');
                                suggestie.classList.add('cursor-pointer', 'py-2', 'px-4', 'hover:bg-gray-200');
                                suggestie.textContent = zoekType === 'city' ? locatie.display_name.split(',')[0] : locatie.display_name;

                                suggestie.addEventListener('click', () => {
                                    invoer.value = suggestie.textContent.split(',')[0];
                                    suggestieBox.innerHTML = '';
                                    if (callback) callback(locatie);
                                });
                                suggestieBox.appendChild(suggestie);
                            });
                            suggestieBox.classList.remove('hidden');
                        } else {
                            suggestieBox.classList.add('hidden');
                        }
                    })
                    .catch((err) => console.error('Fout bij het ophalen van suggesties:', err));
            } else {
                suggestieBox.innerHTML = '';
                suggestieBox.classList.add('hidden');
            }
        });
    };

    // Functie om de autocomplete van stad in te stellen
    const instelStadAutocomplete = () => {
        instelAutocomplete('stad', 'stad-suggestions', 'city', (locatie) => {
            const latField = document.getElementById('latitude');
            const lonField = document.getElementById('longitude');
            const { lat, lon } = locatie;
            if (latField && lonField) {
                latField.value = lat;
                lonField.value = lon;
            }
            initKaart(lat, lon);
        });
    };

    // Functie om postcode automatisch stad en straatnaam in te vullen
    const instelPostcodeAutocomplete = () => {
        const invoer = document.getElementById('postcode');
        if (invoer) {
            invoer.addEventListener('blur', () => {
                const postcode = invoer.value.trim();
                if (postcode.length > 0) {
                    haalCoordinaten(postcode).then(({ lat, lon }) => {
                        const latField = document.getElementById('latitude');
                        const lonField = document.getElementById('longitude');
                        if (latField && lonField) {
                            latField.value = lat;
                            lonField.value = lon;
                        }
                        initKaart(lat, lon);
                        haalStraten(lat, lon);
                    });
                }
            });
        }
    };

    // Haalt straatnaam en stad op voor gegeven coördinaten
    const haalStraten = (lat, lon) => {
        const straatnaamInput = document.getElementById('straatnaam');
        const stadInput = document.getElementById('stad');

        if (!lat || !lon || !straatnaamInput || !stadInput) {
            console.error('Sommige invoerelementen ontbreken');
            return;
        }

        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}&zoom=18&addressdetails=1`)
            .then((res) => res.json())
            .then((data) => {
                if (data && data.address) {
                    straatnaamInput.value = data.address.road || '';
                    stadInput.value = data.address.city || data.address.town || data.address.village || data.address.state || '';
                }
            })
            .catch((err) => console.error('Fout bij het ophalen van straatnamen en stad:', err));
    };

    // Afbeelding verwijderen
    const verwijderAfbeelding = () => {
        document.querySelectorAll('.delete-image-button').forEach((button) => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const afbeeldingId = button.getAttribute('data-image-id');
                fetch(`/verhuurder/huizen/afbeeldingen/${afbeeldingId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        Accept: 'application/json',
                    },
                })
                    .then((res) => (res.ok ? button.closest('.relative').remove() : console.error('Fout bij het verwijderen van de afbeelding.')))
                    .catch((err) => console.error('Fout bij het verwijderen van de afbeelding:', err));
            });
        });
    };

    // Prijs sliders instellen
    const updatePrijsLabels = () => {
        const minSlider = document.getElementById('min_prijs');
        const maxSlider = document.getElementById('max_prijs');
        const minLabel = document.getElementById('min-prijs-label');
        const maxLabel = document.getElementById('max-prijs-label');

        if (minSlider && maxSlider && minLabel && maxLabel) {
            minSlider.addEventListener('input', () => {
                minLabel.textContent = `€${minSlider.value}`;
                maxSlider.min = minSlider.value;
            });
            maxSlider.addEventListener('input', () => {
                maxLabel.textContent = `€${maxSlider.value}`;
                minSlider.max = maxSlider.value;
            });
        }
    };
    // Slideshow functionaliteit
    const slides = document.querySelectorAll("#slideshow .slide");
    let currentSlide = 0;

    const showSlide = (index) => {
        slides[currentSlide]?.classList.remove("active");
        currentSlide = (index + slides.length) % slides.length;
        slides[currentSlide]?.classList.add("active");
    };

    document.getElementById("prev")?.addEventListener('click', () => showSlide(currentSlide - 1));
    document.getElementById("next")?.addEventListener('click', () => showSlide(currentSlide + 1));

    if (slides.length > 0) {
        slides[0].classList.add("active"); // Start met de eerste slide zichtbaar
    }

    // Sterbeoordeling
    const starRating = document.getElementById('star-rating');
    const ratingInput = document.getElementById('rating-input');

    if (starRating && ratingInput) {
        starRating.addEventListener('click', (e) => {
            if (e.target.classList.contains('fa-star')) {
                const ratingValue = e.target.getAttribute('data-value');
                ratingInput.value = ratingValue;
                Array.from(starRating.children).forEach((star, index) => {
                    star.classList.toggle('text-yellow-500', index < ratingValue);
                    star.classList.toggle('text-gray-300', index >= ratingValue);
                });
            }
        });
    }

    // Activeer functies indien nodig
    if (document.getElementById('map')) instelKaart();
    if (typeof verwijderAfbeelding === 'function') verwijderAfbeelding();
    if (typeof beheerFavorieten === 'function') beheerFavorieten();
    if (typeof instelStadAutocomplete === 'function') instelStadAutocomplete();
    if (typeof instelPostcodeAutocomplete === 'function') instelPostcodeAutocomplete();
    if (typeof updatePrijsLabels === 'function') updatePrijsLabels();
});
