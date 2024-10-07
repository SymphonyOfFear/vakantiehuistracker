<!-- edit.blade.php -->
<x-app-layout>
    <x-header />

    <div class="flex">
        <x-sidebar title="Huizenbeheer">
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                    Huizen</a></li>
            <li><a href="{{ route('verhuurder.huizen.create') }}" class="text-gray-700 hover:text-green-600">Voeg Huis
                    Toe</a></li>
        </x-sidebar>

        <div class="w-full lg:w-3/4 p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">Bewerk Vakantiehuis: {{ $vakantiehuis->naam }}</h1>

            <!-- Include the form blade with the vakantiehuis data -->
            @include('verhuurder.huizen.partials.form', ['vakantiehuis' => $vakantiehuis])
        </div>
    </div>

    <x-footer />
</x-app-layout>
