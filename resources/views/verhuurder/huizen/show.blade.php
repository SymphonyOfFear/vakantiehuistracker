<x-app-layout>
    <div class="flex lg:flex-nowrap flex-wrap min-h-screen">
        <x-sidebar title="Menu" class="lg:min-h-screen">
            <li><a href="{{ route('verhuurder.dashboard') }}" class="text-gray-700 hover:text-green-600">Dashboard</a>
            </li>
            <li><a href="{{ route('verhuurder.huizen.index') }}"
                    class="text-gray-700 hover:text-green-600">Huizenbeheer</a></li>
            <li><a href="{{ route('recensies.index') }}" class="text-gray-700 hover:text-green-600">Recensies</a></li>
            <li><a href="{{ route('reserveringen.index') }}" class="text-gray-700 hover:text-green-600">Reserveringen</a>
            </li>
            <li><a href="{{ route('favorieten.index') }}" class="text-gray-700 hover:text-green-600">Favorieten</a></li>
        </x-sidebar>

        <div class="w-full lg:w-3/4 p-6 bg-white">
            <nav class="text-gray-500 text-sm mb-4">
                <a href="{{ route('huizen.index') }}" class="hover:text-green-600">Huizen</a> &gt;
                <span>{{ $vakantiehuis->stad }}</span> &gt;
                <span>{{ $vakantiehuis->straatnaam }} {{ $vakantiehuis->huisnummer }}</span>
            </nav>

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">{{ $vakantiehuis->naam }}</h1>
                @if (Auth::id() === $vakantiehuis->user_id)
                    <a href="{{ route('verhuurder.huizen.edit', $vakantiehuis->id) }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Bewerk</a>
                @endif
            </div>

            @if ($vakantiehuis->images->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="md:col-span-2">
                        <img src="{{ $vakantiehuis->images->first()->url }}" alt="{{ $vakantiehuis->naam }}"
                            class="w-full h-auto object-cover rounded-lg">
                    </div>
                    <div class="md:col-span-2 grid grid-cols-2 gap-2">
                        @foreach ($vakantiehuis->images->slice(1) as $image)
                            <img src="{{ $image->url }}" alt="{{ $vakantiehuis->naam }}"
                                class="w-full h-40 object-cover rounded-lg">
                        @endforeach
                    </div>
                </div>
            @else
                <div class="mb-6">
                    <img src="https://via.placeholder.com/600x400.png?text=Geen+Afbeeldingen+Beschikbaar"
                        alt="Geen afbeeldingen beschikbaar" class="w-full h-auto object-cover rounded-lg">
                </div>
            @endif

            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h2 class="text-xl font-semibold mb-2">Locatie op de kaart</h2>
                <div id="map" class="w-full h-64 rounded-lg shadow" data-lat="{{ $vakantiehuis->latitude }}"
                    data-lon="{{ $vakantiehuis->longitude }}"></div>
                <a href="https://www.google.com/maps/search/?api=1&query={{ $vakantiehuis->latitude }},{{ $vakantiehuis->longitude }}"
                    class="text-blue-500 hover:underline mt-2 block">Bekijk op Google Maps</a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h2 class="text-xl font-semibold mb-2">Beschrijving</h2>
                <p class="text-gray-700">{{ $vakantiehuis->beschrijving ?? 'Geen beschrijving beschikbaar.' }}</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h2 class="text-xl font-semibold mb-4">Recensies</h2>
                <div class="space-y-4">
                    @foreach ($vakantiehuis->recensies as $recensie)
                        <div class="border-b border-gray-200 py-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-800 font-semibold">{{ $recensie->user->name }}</span>
                                <span class="text-sm text-gray-500">{{ $recensie->created_at->format('d-m-Y') }}</span>
                            </div>
                            <p class="text-gray-700">{{ $recensie->comment }}</p>
                            <div class="flex items-center">
                                <span class="text-yellow-500">Rating: </span>
                                <div class="ml-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="fa fa-star {{ $i <= $recensie->rating ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @auth
                    <form action="{{ route('recensies.store', $vakantiehuis->id) }}" method="POST" class="mt-4">
                        @csrf
                        <div class="mb-4">
                            <label for="rating" class="block text-gray-700 font-medium">Beoordeling</label>
                            <div id="star-rating" class="flex items-center space-x-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa fa-star text-gray-300 cursor-pointer {{ $vakantiehuis->Beoordeling(auth()->id()) >= $i ? 'text-yellow-500' : '' }}"
                                        data-value="{{ $i }}"></i>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="rating-input"
                                value="{{ $vakantiehuis->Beoordeling(auth()->id()) }}">
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
                                            <option value="">Selecteer een Beoordeling</option>
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
                        @auth
                            <form action="{{ route('recensies.store', $vakantiehuis->id) }}" method="POST" class="mt-4">
                                @csrf
                                <div class="mb-4">
                                    <label for="rating" class="block text-gray-700 font-medium">Beoordeling</label>
                                    <div id="star-rating" class="flex items-center space-x-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star text-gray-300 cursor-pointer {{ $vakantiehuis->Beoordeling(auth()->id()) >= $i ? 'text-yellow-500' : '' }}"
                                                data-value="{{ $i }}"></i>
                                        @endfor
                                    </div>
                                    <input type="hidden" name="rating" id="rating-input"
                                        value="{{ user->Beoordeling(auth()->id()) }}">
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
                                <input type="text" id="naam" name="naam" class="w-full p-2 border rounded-lg"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block text-gray-700">E-mail:</label>
                                <input type="email" id="email" name="email" class="w-full p-2 border rounded-lg"
                                    required>
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

        <div>
            <a href="{{ route('huizen.index') }}"
                class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">Terug naar
                overzicht</a>
        </div>
        </div>
        </div>
    </x-app-layout>
