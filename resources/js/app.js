import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {

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
    const slides = document.querySelectorAll("#slideshow .slide");
    let huidigeSlide = 0;

    const toonSlide = (index) => {
        slides[huidigeSlide].classList.remove("active");
        huidigeSlide = (index + slides.length) % slides.length;
        slides[huidigeSlide].classList.add("active");
    };

    document.getElementById("prev")?.addEventListener('click', () => toonSlide(huidigeSlide - 1));
    document.getElementById("next")?.addEventListener('click', () => toonSlide(huidigeSlide + 1));

    let kaart;

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

    const haalCoordinaten = async (postcode) => {
        const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(postcode)}&countrycodes=NL`;
        try {
            const res = await fetch(url);
            const data = await res.json();
            return data.length > 0 ? { lat: parseFloat(data[0].lat), lon: parseFloat(data[0].lon) } : null;
        } catch {
            return { lat: 52.3676, lon: 4.9041 };
        }
    };

    const beheerFavorieten = () => {
        document.querySelectorAll('.favoriet-form').forEach((form) => {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const id = form.dataset.id;
                try {
                    const res = await fetch(`/favorieten/toggle/${id}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            Accept: 'application/json',
                        },
                    });
                    if (res.ok) location.reload();
                } catch (err) {
                    console.error('Fout:', err);
                }
            });
        });
    };

    const instelAutocomplete = (invoerId, suggestieId, zoekType, callback) => {
        const invoer = document.getElementById(invoerId);
        const suggestieBox = document.getElementById(suggestieId);

        invoer?.addEventListener('input', async () => {
            const zoekterm = invoer.value.trim();
            if (zoekterm.length < 3) return suggestieBox.classList.add('hidden');

            try {
                const res = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(zoekterm)}&countrycodes=NL`);
                const data = await res.json();
                suggestieBox.innerHTML = data.map(loc => `<div class="suggestie">${loc.display_name}</div>`).join('');
                suggestieBox.classList.remove('hidden');
                suggestieBox.querySelectorAll('.suggestie').forEach((suggestie, index) => {
                    suggestie.addEventListener('click', () => {
                        invoer.value = suggestie.textContent.split(',')[0];
                        suggestieBox.classList.add('hidden');
                        callback(data[index]);
                    });
                });
            } catch (err) {
                console.error("Fout bij het ophalen van suggesties:", err);
            }
        });
    };

    const verwijderAfbeelding = () => {
        document.querySelectorAll('.delete-image-button').forEach((button) => {
            button.addEventListener('click', async (e) => {
                e.preventDefault();
                const afbeeldingId = button.dataset.imageId;
                try {
                    const res = await fetch(`/verhuurder/huizen/afbeeldingen/${afbeeldingId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            Accept: 'application/json',
                        },
                    });
                    if (res.ok) button.closest('.relative').remove();
                } catch (err) {
                    console.error('Fout bij het verwijderen van de afbeelding:', err);
                }
            });
        });
    };

    const updatePrijsLabels = () => {
        const minSlider = document.getElementById('min_prijs');
        const maxSlider = document.getElementById('max_prijs');
        const minLabel = document.getElementById('min-prijs-label');
        const maxLabel = document.getElementById('max-prijs-label');

        minSlider?.addEventListener('input', () => {
            minLabel.textContent = `€${minSlider.value}`;
            maxSlider.min = minSlider.value;
        });
        maxSlider?.addEventListener('input', () => {
            maxLabel.textContent = `€${maxSlider.value}`;
            minSlider.max = maxSlider.value;
        });
    };

    // Activeer functies indien nodig
    if (document.getElementById('map')) initKaart(52.3676, 4.9041);  // Standaard coördinaten
    beheerFavorieten();
    verwijderAfbeelding();
    updatePrijsLabels();

    // Autocomplete instellingen
    instelAutocomplete('stad', 'stad-suggestions', 'city', (loc) => initKaart(loc.lat, loc.lon));
    instelAutocomplete('postcode', 'postcode-suggestions', 'postcode', async (loc) => {
        const coordinaten = await haalCoordinaten(loc.postcode);
        if (coordinaten) initKaart(coordinaten.lat, coordinaten.lon);
    });

    window.toggleSidebar = () => {
        const sidebar = document.getElementById('sidebar');
        const sidebarButton = document.getElementById('showSidebarButton');
        sidebar.classList.toggle('hidden');
        sidebarButton.classList.toggle('hidden');
    };
});
