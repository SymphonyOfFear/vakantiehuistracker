<x-app-layout>
    <x-header />
    <div class="min-h-screen bg-green-100 py-16">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">{{ $huisje->naam }}</h1>

            <!-- House details -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <img src="{{ $huisje->afbeelding ?? 'https://placehold.co/600x400' }}" alt="{{ $huisje->naam }}"
                    class="w-full h-96 object-cover rounded-lg mb-4">
                <p><strong>Locatie:</strong> {{ $huisje->locatie }}</p>
                <p><strong>Prijs:</strong> € {{ $huisje->prijs }}</p>
                <p><strong>Aantal slaapkamers:</strong> {{ $huisje->slaapkamers }}</p>

                <!-- Amenities -->
                <h3 class="mt-6 text-xl font-semibold">Voorzieningen</h3>
                <ul class="list-disc list-inside">
                    @if ($huisje->zwembad)
                        <li>Zwembad</li>
                    @endif
                    @if ($huisje->wifi)
                        <li>Wi-Fi</li>
                    @endif
                    @if ($huisje->spa)
                        <li>Spa</li>
                    @endif
                    @if ($huisje->speeltuin)
                        <li>Speeltuin</li>
                    @endif
                </ul>
                <p><strong>Beschikbaar:</strong>
                    @if ($huisje->beschikbaarheid)
                        Beschikbaar
                    @else
                        Niet Beschikbaar
                    @endif
                </p>
            </div>
            <div class="flex">
                <!-- Sidebar -->
                <x-sidebar title="Huizenbeheer">
                    <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                            Huizen</a></li>
                    <li><a href="{{ route('verhuurder.huizen.create') }}"
                            class="text-gray-700 hover:text-green-600">Voeg Huis
                            Toe</a></li>
                </x-sidebar>

                <!-- Main Content -->
                <div class="w-full lg:w-3/4 p-6 bg-white">
                    <h1 class="text-2xl font-bold mb-4">{{ $vakantiehuis->naam }}</h1>
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-lg text-gray-800">{{ $vakantiehuis->straatnaam }}
                            {{ $vakantiehuis->huisnummer }},
                            {{ $vakantiehuis->postcode }} {{ $vakantiehuis->stad }}</p>
                        @if (Auth::id() === $vakantiehuis->verhuurder_id)
                            <a href="{{ route('verhuurder.huizen.edit', $vakantiehuis->id) }}"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Bewerk</a>
                        @endif
                    </div>

                    <!-- Image Gallery -->
                    @if ($vakantiehuis->images->isNotEmpty())
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach ($vakantiehuis->images as $image)
                                <div class="bg-white shadow rounded">
                                    <img src="{{ $image->url }}" alt="{{ $vakantiehuis->naam }}"
                                        class="w-full h-48 object-cover rounded">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="mb-6">
                            <img src="https://via.placeholder.com/600x400.png?text=Geen+Afbeeldingen+Beschikbaar"
                                alt="Geen afbeeldingen beschikbaar" class="w-full h-auto object-cover rounded-lg">
                        </div>
                    @endif

                    <!-- Beschrijving sectie -->
                    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                        <h2 class="text-xl font-semibold mb-2">Beschrijving</h2>
                        <p class="text-gray-700">{{ $vakantiehuis->beschrijving ?? 'Geen beschrijving beschikbaar.' }}
                        </p>
                    </div>

                    <!-- Map Section -->
                    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                        <h2 class="text-xl font-semibold mb-2">Locatie op de kaart</h2>
                        <div id="map" class="w-full h-64 rounded-lg shadow"></div>
                    </div>

                    <!-- Commentaarsectie -->
                    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                        <h2 class="text-xl font-semibold mb-4">Recensies</h2>
                        <!-- Toon alle recensies -->
                        @foreach ($vakantiehuis->recensies as $recensie)
                            <div class="border-b border-gray-200 py-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-800 font-semibold">{{ $recensie->user->name }}</span>
                                    <span
                                        class="text-sm text-gray-500">{{ $recensie->created_at->format('d-m-Y') }}</span>
                                </div>
                                <p class="text-gray-700">{{ $recensie->comment }}</p>
                                <p class="text-yellow-500">Rating: {{ $recensie->rating }}/5</p>
                            </div>
                        @endforeach

                        <!-- Recensie toevoegen -->
                        @auth
                            <form action="{{ route('recensies.store', $vakantiehuis->id) }}" method="POST" class="mt-4">
                                @csrf
                                <div class="mb-4">
                                    <label for="rating" class="block text-gray-700 font-medium">Beoordeling</label>
                                    <select name="rating" id="rating"
                                        class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                                        <option value="">Selecteer een beoordeling</option>
                                        <option value="1">1 Ster</option>
                                        <option value="2">2 Sterren</option>
                                        <option value="3">3 Sterren</option>
                                        <option value="4">4 Sterren</option>
                                        <option value="5">5 Sterren</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="comment" class="block text-gray-700 font-medium">Opmerking</label>
                                    <textarea name="comment" id="comment" rows="4"
                                        class="w-full mt-1 p-2 border border-gray-300 rounded-md resize-none" required></textarea>
                                </div>
                                <button type="submit"
                                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Plaats
                                    Recensie</button>
                            </form>
                        @endauth
                    </div>

                    <!-- Terug naar overzicht knop -->
                    <div>
                        <a href="{{ route('huizen.index') }}"
                            class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">Terug naar
                            overzicht</a>
                    </div>
                    <!-- Feedback Section -->
                    <div class="mt-10">
                        <button id="feedbackToggle"
                            class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring">
                            Geef Feedback
                        </button>

                        <div id="feedbackForm" class="hidden mt-4 bg-white p-6 rounded-lg shadow-lg">
                            <h3 class="text-xl font-semibold mb-4">Jouw Feedback</h3>

                            <form action="{{ route('verhuurder.feedback.store', ['huisjeId' => $huisje->id]) }}"
                                method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="naam" class="block text-gray-700">Naam:</label>
                                    <input type="text" id="naam" name="naam"
                                        class="w-full p-2 border rounded-lg" required>
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="block text-gray-700">E-mail:</label>
                                    <input type="email" id="email" name="email"
                                        class="w-full p-2 border rounded-lg" required>
                                </div>

                                <div class="mb-4">
                                    <label for="feedback" class="block text-gray-700">Feedback:</label>
                                    <textarea id="feedback" name="feedback" rows="4" class="w-full p-2 border rounded-lg" required></textarea>
                                </div>

                                <button type="submit"
                                    class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 focus:outline-none focus:ring">
                                    Verstuur Feedback
                                </button>
                            </form>
                        </div>

                        @if ($feedbacks->isEmpty())
                            <p>Er is nog geen feedback.</p>
                        @else
                            <ul>
                                @foreach ($feedbacks as $feedback)
                                    <li class="mb-4">
                                        <p><strong>{{ $feedback->naam }}</strong>
                                            {{-- ({{ $feedback->email }}) --}}
                                        </p>
                                        <p>{{ $feedback->feedback }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                </div>
            </div>

            <x-footer />

            <script>
                // Toggle feedback form visibility
                const feedbackToggle = document.getElementById('feedbackToggle');
                const feedbackForm = document.getElementById('feedbackForm');

                feedbackToggle.addEventListener('click', function() {
                    feedbackForm.classList.toggle('hidden');
                });
            </script>
</x-app-layout>
