<x-app-layout>
    <div class="flex lg:flex-nowrap flex-wrap min-h-screen">
        <!-- Sidebar -->
        <x-sidebar title="Vakantiehuizen">
            <li><a href="{{ route('huizen.index') }}" class="text-gray-700 hover:text-green-600">Alle Huizen</a></li>
            <li><a href="{{ route('favorieten.index') }}" class="text-gray-700 hover:text-green-600">Favorieten</a></li>
            <li><a href="{{ route('reserveringen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                    Reserveringen</a></li>
        </x-sidebar>

        <!-- Main Content Area -->
        <div class="flex-grow p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">Beschikbare Vakantiehuizen</h1>

            @if ($huizen->isEmpty())
                <p class="text-gray-600">Er zijn momenteel geen vakantiehuizen beschikbaar.</p>
            @else
                <!-- Card Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($huizen as $huis)
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden flex flex-col justify-between h-full">
                            <!-- Image -->
                            <img src="{{ $huis->images->first()->url ?? 'https://via.placeholder.com/300x200' }}"
                                alt="{{ $huis->naam }}" class="w-full h-40 object-cover rounded-t-lg">

                            <!-- Content -->
                            <div class="p-4 flex-grow">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $huis->naam }}</h3>
                                <p class="text-sm text-gray-600 mt-2">{{ Str::limit($huis->beschrijving, 80) }}</p>
                                <p class="text-green-600 font-bold mt-2">€ {{ $huis->prijs }}</p>
                                <div class="mt-2">
                                    @if ($huis->wifi)
                                        <span class="text-sm text-blue-500">Wi-Fi</span>
                                    @endif
                                    @if ($huis->zwembad)
                                        <span class="text-sm text-blue-500">Zwembad</span>
                                    @endif
                                    @if ($huis->parkeren)
                                        <span class="text-sm text-gray-500">Parkeren</span>
                                    @endif
                                    @if ($huis->speeltuin)
                                        <span class="text-sm text-yellow-500">Speeltuin</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="p-4 bg-gray-50 flex justify-between items-center">
                                <a href="{{ route('huizen.show', $huis->id) }}"
                                    class="text-blue-600 hover:underline">Bekijk details</a>
                                <form class="favorite-form" data-id="{{ $huis->id }}" method="POST"
                                    action="{{ route('favorieten.toggle', $huis->id) }}">
                                    @csrf
                                    <button type="submit" class="text-2xl">
                                        <i
                                            class="fas fa-heart {{ $huis->favorieten()->where('user_id', Auth::id())->exists() ? 'text-red-600' : 'text-black' }}"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
