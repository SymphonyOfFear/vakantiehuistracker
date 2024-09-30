<x-app-layout>
    <x-header />

    <div class="flex">


        <div class="w-full lg:w-3/4 p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">{{ $vakantiehuis->naam }}</h1>

            <p><strong>Prijs: </strong>€{{ $vakantiehuis->prijs }}</p>
            <p><strong>Beschrijving: </strong>{{ $vakantiehuis->beschrijving }}</p>

            <div id="map" style="height: 400px;"></div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
