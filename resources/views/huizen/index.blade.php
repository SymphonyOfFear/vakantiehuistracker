<x-app-layout>
    <x-header />

    <div class="flex">
        <!-- Sidebar / Filters -->
        <x-filter />

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">Vakantiehuizen</h1>

            <!-- Search Bar with Auto-Suggestion for Stad -->
            <form action="{{ route('huizen.index') }}" method="GET" class="mb-4 flex items-center space-x-4">
                <div class="relative w-full">
                    <input type="text" id="stad" name="stad" placeholder="Typ een plaats, buurt of postcode"
                        class="w-full px-6 py-4 border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
                    <!-- Suggestiebox voor steden -->
                    <div id="stad-suggestions"
                        class="absolute z-10 w-full bg-white shadow-lg border border-gray-200 mt-1 rounded-md max-h-60 overflow-y-auto hidden">
                    </div>
                </div>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Zoeken</button>
            </form>

            @if ($vakantiehuizen->isEmpty())
                <p class="text-gray-600">Geen vakantiehuizen beschikbaar.</p>
            @else
                <!-- List of Vacation Homes -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                    @foreach ($vakantiehuizen as $huis)
                        <div class="relative bg-white p-4 rounded-lg shadow">
                            <!-- Show first image of vacation home -->
                            <img src="{{ $huis->images->first()->url ?? 'https://via.placeholder.com/400x300.png?text=Geen+Afbeelding' }}"
                                alt="{{ $huis->naam }}" class="w-full h-48 object-cover rounded-t-lg mb-4">

                            <h3 class="text-xl font-bold text-gray-800">{{ $huis->naam }}</h3>
                            <p class="text-gray-600">{{ $huis->postcode }} {{ $huis->stad }}</p>
                            <p class="text-green-600 font-semibold">€{{ $huis->prijs }}</p>
                            <a href="{{ route('huizen.show', $huis->id) }}"
                                class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Bekijk
                                details</a>

                            <!-- Favorite button -->
                            @php
                                $isFavorited = $huis->isFavoritedBy(Auth::id());
                            @endphp
                            <form action="{{ route('favorieten.toggle', $huis->id) }}" method="POST"
                                class="inline-block">
                                @csrf
                                <button type="submit" class="favorite-button text-2xl">
                                    <i
                                        class="fas fa-heart {{ $huis->isFavoritedBy(Auth::id()) ? 'text-red-600' : 'text-black' }}"></i>
                                </button>
                            </form>

                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <x-footer class="mt-auto" />
</x-app-layout>
