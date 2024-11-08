<x-app-layout>
    <div class="container mx-auto px-4 py-8">
   
        <nav class="text-gray-500 text-sm mb-4">
            <a href="{{ route('huizen.index') }}" class="hover:text-green-600">Huizen</a> &gt;
            <a href="#" class="hover:text-green-600">{{ $vakantiehuis->stad }}</a> &gt;
            <span>{{ $vakantiehuis->straatnaam }} {{ $vakantiehuis->huisnummer }}</span>
        </nav>


        <div class="flex flex-col lg:flex-row gap-8">
        
            <div class="w-full lg:w-2/3">
                <div id="slideshow" class="relative overflow-hidden rounded-lg shadow-lg">
                    @foreach($vakantiehuis->images as $image)
                        <div class="slide {{ $loop->first ? 'active' : '' }}" style="display: {{ $loop->first ? 'block' : 'none' }};">
                            <img src="{{ asset($image->url) }}" alt="{{ $vakantiehuis->naam }}" class="w-full h-80 object-cover rounded-lg">
                        </div>
                    @endforeach
                    <button id="prev" class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full">&#10094;</button>
                    <button id="next" class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full">&#10095;</button>
                </div>
            </div>

            <div class="w-full lg:w-1/3 bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-3xl font-bold text-gray-800">{{ $vakantiehuis->naam }}</h1>
                    <form class="favoriet-form" data-id="{{ $vakantiehuis->id }}" method="POST" action="{{ route('favorieten.toggle', $vakantiehuis->id) }}">
                        @csrf
                        <button type="submit" class="text-2xl">
                            <i class="fas fa-heart {{ $vakantiehuis->FavorietenChecker(Auth::id()) ? 'text-red-600' : 'text-gray-400' }}"></i>
                        </button>
                    </form>
                </div>
                <p class="text-gray-600">{{ $vakantiehuis->straatnaam }} {{ $vakantiehuis->huisnummer }}, {{ $vakantiehuis->stad }}</p>
                <p class="text-green-600 font-semibold text-xl mt-2">€{{ number_format($vakantiehuis->prijs, 2) }} per nacht</p>

                <h2 class="font-semibold text-lg mt-4 mb-2">Voorzieningen:</h2>
                <ul class="grid grid-cols-2 gap-2 text-gray-700">
                    <li>Wi-Fi: <span class="font-semibold">{{ $vakantiehuis->wifi ? 'Ja' : 'Nee' }}</span></li>
                    <li>Zwembad: <span class="font-semibold">{{ $vakantiehuis->zwembad ? 'Ja' : 'Nee' }}</span></li>
                    <li>Parkeren: <span class="font-semibold">{{ $vakantiehuis->parkeren ? 'Ja' : 'Nee' }}</span></li>
                    <li>Speeltuin: <span class="font-semibold">{{ $vakantiehuis->speeltuin ? 'Ja' : 'Nee' }}</span></li>
                </ul>

                <div class="mt-6 space-y-2">
                    @auth
                        @if(Auth::user()->HasRole('huurder'))
                            <a href="{{ route('reserveringen.create', $vakantiehuis->id) }}" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition text-center block">Reserveren</a>
                        @elseif(Auth::user()->HasRole('verhuurder'))
                            <a href="{{ route('verhuurder.huizen.edit', $vakantiehuis->id) }}" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition text-center block">Bewerken</a>
                            <form action="{{ route('verhuurder.huizen.destroy', $vakantiehuis->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition">Verwijderen</button>
                            </form>
                        @elseif(Auth::user()->HasRole('admin'))
                            <div class="mt-4 space-y-2">
                                <a href="{{ route('admin.huizen.overview') }}" class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition text-center block">Bekijk alle huizen</a>
                                <a href="{{ route('verhuurder.huizen.edit', $vakantiehuis->id) }}" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition text-center block">Beheer Vakantiehuis</a>
                                <a href="{{ route('admin.users.edit', $vakantiehuis->user_id) }}" class="w-full bg-teal-600 text-white py-2 rounded-lg hover:bg-teal-700 transition text-center block">Beheer Verhuurder</a>
                            </div>
                        @endif
                    @endauth
                </div>
                
            </div>
        </div>


        <div class="bg-white p-6 rounded-lg shadow-md mt-8">
            <h2 class="text-xl font-semibold mb-4">Locatie op de kaart</h2>
            <div id="map" class="w-full h-64 rounded-lg shadow" data-lat="{{ $vakantiehuis->latitude }}" data-lon="{{ $vakantiehuis->longitude }}"></div>
            <a href="https://www.google.com/maps/search/?api=1&query={{ $vakantiehuis->latitude }},{{ $vakantiehuis->longitude }}" class="text-blue-500 hover:underline mt-2 block">Bekijk op Google Maps</a>
        </div>


        <div class="bg-white p-6 rounded-lg shadow-md mt-8">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">Beschrijving</h2>
            <p class="text-gray-700">{{ $vakantiehuis->beschrijving ?? 'Geen beschrijving beschikbaar.' }}</p>
        </div>


        <div class="bg-white p-6 rounded-lg shadow-md mt-8">
            <h2 class="text-xl font-semibold mb-4">Recensies</h2>
            @if ($vakantiehuis->recensies->isEmpty())
                <p class="text-gray-500">Deze vakantiehuis heeft nog geen opmerkingen.</p>
            @else
                @foreach ($vakantiehuis->recensies as $recensie)
                    <div class="border-b border-gray-200 py-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-800 font-semibold">{{ $recensie->user->name }}</span>
                            <span class="text-sm text-gray-500">{{ $recensie->created_at->format('d-m-Y') }}</span>
                        </div>
                        <p class="text-gray-700">{{ $recensie->opmerking }}</p>
                        <div class="flex items-center text-yellow-500 mt-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa{{ $i <= $recensie->rating ? 's' : 'r' }} fa-star"></i>
                            @endfor
                        </div>
                    </div>
                @endforeach
            @endif

            @auth
                <form action="{{ route('recensies.store', $vakantiehuis->id) }}" method="POST" class="mt-6">
                    @csrf
                    <div class="mb-4">
                        <label for="rating" class="block text-gray-700 font-medium">Beoordeling</label>
                        <div id="star-rating" class="flex items-center space-x-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa fa-star text-gray-300 cursor-pointer" data-value="{{ $i }}"></i>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating-input">
                    </div>
                    <div class="mb-4">
                        <label for="comment" class="block text-gray-700 font-medium">Opmerking</label>
                        <textarea name="comment" id="comment" rows="4" class="w-full mt-1 p-2 border border-gray-300 rounded-md resize-none" required></textarea>
                    </div>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">Plaats Recensie</button>
                </form>
            @endauth
        </div>

      
        <div class="mt-8">
            <a href="{{ route('huizen.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">Terug naar overzicht</a>
        </div>
    </div>
</x-app-layout>
