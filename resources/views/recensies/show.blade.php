<x-app-layout>
    <x-header />

    <div class="min-h-screen bg-green-100 py-16">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">Recensie voor {{ $recensie->vakantiehuis->naam }}</h1>

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-gray-800">{{ $recensie->huurder->name }}</h2>
                <p class="text-gray-600">{{ $recensie->feedback }}</p>
                <p class="text-green-600 font-semibold">Rating: {{ $recensie->rating }} / 5</p>
                <p class="text-gray-600">Gepubliceerd op: {{ $recensie->created_at->format('d-m-Y') }}</p>

                <!-- Respond to Review Form -->
                <h3 class="mt-6 text-xl font-semibold">Reageer op deze recensie</h3>
                <form action="{{ route('recensies.beantwoorden', $recensie->id) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-4">
                        <label for="reactie" class="block text-gray-700">Reactie:</label>
                        <textarea name="reactie" id="reactie" class="w-full px-4 py-2 border rounded-md" required></textarea>
                    </div>
                    <div class="mt-4">
                        <button type="submit"
                            class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                            Reageer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
