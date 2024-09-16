<x-app-layout>
    <div class="container mx-auto py-16">
        <h1 class="text-3xl font-semibold mb-6">Mijn Profiel</h1>

        <!-- User Profile Information -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-4">Gebruikersinformatie</h2>

            <div class="mb-4">
                <label class="block font-semibold">Naam:</label>
                <p>{{ Auth::user()->name }}</p>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Email:</label>
                <p>{{ Auth::user()->email }}</p>
            </div>

            <a href="{{ route('profile.edit') }}"
                class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                Bewerk profiel
            </a>
        </div>
    </div>
</x-app-layout>
