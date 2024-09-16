<x-app-layout>
    <div class="min-h-screen flex flex-col">
        <!-- Header Component -->
        <x-header />

        <!-- Vakantiehuis Details -->
        <div class="flex-grow bg-green-100 py-16">
            <div class="container mx-auto">
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <div class="flex flex-col lg:flex-row">
                        <!-- Foto's -->
                        <div class="w-full lg:w-1/2">
                            <img src="{{ asset('images/' . $vakantiehuis->fotos[0]) }}" alt="{{ $vakantiehuis->naam }}"
                                class="w-full h-auto rounded-lg">
                        </div>

                        <!-- Details -->
                        <div class="w-full lg:w-1/2 lg:pl-8">
                            <h1 class="text-4xl font-bold text-gray-800">{{ $vakantiehuis->naam }}</h1>
                            <p class="text-gray-600 mt-4">{{ $vakantiehuis->locatie }}</p>
                            <p class="text-green-600 font-semibold text-2xl mt-4">
                                €{{ number_format($vakantiehuis->prijs, 2) }}</p>

                            <div class="mt-6">
                                <h2 class="text-xl font-semibold">Voorzieningen</h2>
                                <ul class="list-disc pl-5 mt-2 text-gray-600">
                                    <li>Aantal slaapkamers: {{ $vakantiehuis->slaapkamers }}</li>
                                    <li>Wifi: {{ $vakantiehuis->wifi ? 'Ja' : 'Nee' }}</li>
                                    <li>Zwembad: {{ $vakantiehuis->zwembad ? 'Ja' : 'Nee' }}</li>
                                    <li>Spa: {{ $vakantiehuis->spa ? 'Ja' : 'Nee' }}</li>
                                    <li>Speeltuin: {{ $vakantiehuis->speeltuin ? 'Ja' : 'Nee' }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Component -->
        <x-footer />
    </div>
</x-app-layout>
