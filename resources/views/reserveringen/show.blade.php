<x-app-layout>
    <x-header />

    <div class="min-h-screen bg-green-100 py-16">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">Reservering Details</h1>

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-gray-800">{{ $reservering->vakantiehuis->naam }}</h2>
                <p class="text-gray-600">Locatie: {{ $reservering->vakantiehuis->locatie }}</p>
                <p class="text-green-600 font-semibold">Prijs: € {{ $reservering->vakantiehuis->prijs }}</p>
                <p class="text-gray-600">Startdatum: {{ $reservering->startdatum }}</p>
                <p class="text-gray-600">Einddatum: {{ $reservering->einddatum }}</p>

                <h3 class="mt-6 text-xl font-semibold">Details van de huurder:</h3>
                <p class="text-gray-600">Naam: {{ $reservering->huurder->name }}</p>
                <p class="text-gray-600">Email: {{ $reservering->huurder->email }}</p>

                <!-- Option to cancel reservation if applicable -->
                <form action="{{ route('reserveringen.destroy', $reservering->id) }}" method="POST" class="mt-6">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-6 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                        Annuleer Reservering
                    </button>
                </form>
            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
