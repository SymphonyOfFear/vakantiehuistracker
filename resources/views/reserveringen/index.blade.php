<x-app-layout>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <x-sidebar title="Admin Dashboard"></x-sidebar>

        <!-- Main Content -->
        <div class="flex-1 bg-gradient-to-br from-indigo-50 via-white to-gray-100">
            <!-- Container -->
            <div class="container mx-auto py-6">
                <!-- Nieuwe reservering knop -->
                <div class="flex justify-end mb-6">
                    <a href="{{ route('reserveringen.create') }}" class="bg-emerald-500 text-white font-semibold px-8 py-3 rounded-full shadow-lg hover:bg-emerald-600 hover:shadow-xl transition-all duration-300 transform hover:scale-105 ease-in-out">
                        + Nieuwe Reservering
                    </a>
                </div>

                <!-- Titel -->
                <h1 class="text-5xl font-extrabold text-gray-800 mb-12 text-center tracking-tight">Mijn Reserveringen</h1>

                <!-- Sectie: Vakantiehuizen -->
                <div class="bg-white p-12 rounded-3xl shadow-lg border border-gray-300">
                    <h2 class="text-3xl font-semibold text-gray-700 mb-8 border-b pb-4">Vakantiehuizen die ik huur</h2>

                    <!-- Geen vakantiehuizen -->
                    @if ($gehuurdeHuizen->isEmpty())
                        <div class="text-center py-10">
                            <p class="text-gray-500 text-lg italic">U huurt momenteel geen vakantiehuizen.</p>
                            <a href="{{ route('reserveringen.create') }}" class="mt-5 inline-block bg-indigo-600 text-white px-6 py-3 rounded-full shadow hover:bg-indigo-700 transition duration-300 ease-in-out">
                                Start met Huren
                            </a>
                        </div>
                    @else
                        <!-- Vakantiehuizen Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 mt-8">
                            @foreach ($gehuurdeHuizen as $huis)
                                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-2 hover:scale-105 transition-all duration-300">
                                    <!-- Huis Informatie -->
                                    <div class="p-6">
                                        <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $huis->naam }}</h3>
                                        <p class="text-gray-500 mb-3">Reserveringsnummer: {{ $huis->reserveringen->first()?->reserveringsnummer ?? 'Niet beschikbaar' }}</p>
                                        <p class="text-gray-500 mb-3">Begindatum: {{ $huis->reserveringen->first()?->begindatum ?? 'Niet beschikbaar' }}</p>
                                        <p class="text-gray-500 mb-3">Einddatum: {{ $huis->reserveringen->first()?->einddatum ?? 'Niet beschikbaar' }}</p>
                                        <p class="text-gray-500 mb-3">stad: {{ $huis->stad }}</p>
                                        <p class="text-gray-500 mb-3">straat: {{ $huis->straatnaam }}</p>
                                        <p class="text-gray-500 mb-3">postcode: {{ $huis->postcode }}</p>
                                        <p class="text-gray-500 mb-3">huisnummer: {{ $huis->huisnummer }}</p>
                                        <p class="text-gray-500 mb-3">Huurder: {{ $huis->reserveringen->first()?->huurder?->name ?? 'Niet beschikbaar' }}</p>
                                        <p class="text-emerald-600 font-extrabold text-xl mb-4">€{{ number_format($huis->prijs, 2, ',', '.') }}</p>
                                        <p class="text-gray-500 mb-3">datum van reservatie: {{ $huis->created_at }}</p>

                                        <!-- Verwijder Knop -->
                                        <div class="mt-5 flex justify-between items-center">
                                            <form action="{{ route('reserveringen.destroy', $huis->reserveringen->first()?->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze reservering wilt verwijderen?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 text-white font-medium px-5 py-3 rounded-lg shadow hover:bg-red-700 hover:shadow-lg transition duration-300">
                                                    Verwijder Reservering
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
