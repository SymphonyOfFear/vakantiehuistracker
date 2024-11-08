<x-app-layout>
    <!-- Sidebar -->
    <x-sidebar title="Admin Dashboard"></x-sidebar>

    <!-- Nieuwe reservering knop -->
    <div class="container mx-auto py-6 flex justify-end">
        <a href="{{ route('reserveringen.create') }}" class="bg-green-600 text-white font-semibold px-8 py-3 rounded-full shadow-lg hover:bg-green-700 hover:shadow-xl transition duration-300 transform hover:scale-105 ease-in-out">
            + Nieuwe Reservering
        </a>
    </div>

    <!-- Pagina container -->
    <div class="min-h-screen bg-gradient-to-r from-gray-50 to-gray-100 py-16">
        <div class="container mx-auto px-4 lg:px-0">
            <!-- Titel -->
            <h1 class="text-4xl font-extrabold text-gray-900 mb-10 text-center tracking-wide">Mijn Reserveringen</h1>

            <!-- Sectie: Vakantiehuizen -->
            <div class="bg-white p-12 rounded-xl shadow-2xl border border-gray-200">
                <h2 class="text-3xl font-semibold text-gray-800 mb-6 border-b pb-4">Vakantiehuizen die ik huur</h2>

                <!-- Geen vakantiehuizen -->
                @if ($gehuurdeHuizen->isEmpty())
                    <p class="text-gray-600 text-lg italic">U huurt momenteel geen vakantiehuizen.</p>
                @else
                    <!-- Vakantiehuizen Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mt-8">
                        @foreach ($gehuurdeHuizen as $huis)
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg transform hover:scale-105 hover:shadow-2xl transition duration-300">
                                <!-- Afbeelding -->
                                <img src="{{ $huis->fotos[0] ?? 'https://placehold.co/400' }}" alt="{{ $huis->naam }}" class="w-full h-56 object-cover rounded-t-lg transition duration-300 hover:opacity-90">

                                <!-- Huis Informatie -->
                                <div class="p-6">
                                    <h3 class="text-2xl font-semibold text-gray-900 mb-2">{{ $huis->naam }}</h3>
                                    <p class="text-gray-500 mb-3 text-sm">{{ $huis->adres }}</p>
                                    <p class="text-green-600 font-bold text-xl mb-4">€{{ $huis->prijs }}</p>

                                    <!-- Bekijk Knop -->
                                    <div class="mt-5">
                                        <a href="{{ route('verhuurder.huizen.show', $huis->id) }}" class="inline-block bg-blue-500 text-white font-medium px-5 py-2 rounded-lg shadow-md hover:bg-blue-600 hover:shadow-lg transition duration-200 ease-in-out">
                                            Bekijk
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
