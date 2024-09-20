<x-app-layout>
    <x-header />
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">{{ $vakantiehuis->naam }}</h1>
        <div class="bg-white p-4 rounded-lg shadow">
            <img src="{{ $vakantiehuis->afbeelding ?? 'https://placehold.co/400' }}" alt="{{ $vakantiehuis->naam }}"
                class="w-full h-64 object-cover mb-4">
            <p class="text-gray-600">{{ $vakantiehuis->beschrijving }}</p>
            <p class="mt-4 text-green-600 font-semibold">€ {{ $vakantiehuis->prijs }}</p>
            <p class="mt-4">Locatie: {{ $vakantiehuis->locatie }}</p>
            <p>Slaapkamers: {{ $vakantiehuis->slaapkamers }}</p>
        </div>
        <a href="{{ route('huizen.index') }}"
            class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
            Terug naar overzicht
        </a>
    </div>
    <x-footer />
</x-app-layout>
