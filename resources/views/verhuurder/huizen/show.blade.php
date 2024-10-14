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

            <!-- Feedback Section -->
            <div class="mt-10">
                <button id="feedbackToggle"
                    class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring">
                    Geef Feedback
                </button>

                <div id="feedbackForm" class="hidden mt-4 bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4">Jouw Feedback</h3>

                    <form action="{{ route('verhuurder.feedback.store', ['huisjeId' => $huisje->id]) }}" method="POST">
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
