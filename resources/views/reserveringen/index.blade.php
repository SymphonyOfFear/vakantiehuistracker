<x-app-layout>
    <!-- Sidebar -->
    <x-sidebar title="Admin Dashboard"></x-sidebar>

    <!-- Nieuwe reservering knop -->
    <div class="container mx-auto py-6 flex justify-end">
        <a href="{{ route('reserveringen.create') }}" class="bg-emerald-500 text-white font-semibold px-8 py-3 rounded-full shadow-lg hover:bg-emerald-600 hover:shadow-xl transition-all duration-300 transform hover:scale-105 ease-in-out">
            + Nieuwe Reservering
        </a>
    </div>

    <!-- Pagina container -->
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-gray-100 py-16">
        <div class="container mx-auto px-4 lg:px-0">
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
                            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transform hover:-translate-y-2 hover:scale-105 transition-all duration-300">
                                <!-- Afbeelding -->
                                <img src="{{ $huis->fotos[0] ?? asset('images/default-placeholder.png') }}" alt="{{ $huis->naam }}" class="w-full h-56 object-cover rounded-t-lg transition duration-300 hover:opacity-90">

                                <!-- Huis Informatie -->
                                <div class="p-6">
                                    <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $huis->naam }}</h3>
                                    <p class="text-gray-500 mb-3">{{ $huis->adres }}</p>
                                    <p class="text-emerald-600 font-extrabold text-xl mb-4">€{{ number_format($huis->prijs, 2, ',', '.') }}</p>

                                    <!-- Bekijk Knop -->
                                    <div class="mt-5">
                                        <a href="{{ route('verhuurder.huizen.show', $huis->id) }}" class="inline-block bg-blue-600 text-white font-medium px-5 py-3 rounded-lg shadow hover:bg-blue-700 hover:shadow-lg transition duration-300">
                                            Bekijk Details
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
