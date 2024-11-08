<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Vakantiehuizen Overzicht</h1>

      
        <div class="flex justify-between items-center mb-4">
            <form action="{{ route('admin.huizen.overview') }}" method="GET" class="flex space-x-2">
                <input type="text" name="zoekopdracht" placeholder="Zoek op naam, stad of eigenaar" value="{{ request('zoekopdracht') }}" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Zoek</button>
            </form>
            <a href="{{ route('verhuurder.huizen.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Nieuw Vakantiehuis Toevoegen</a>
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-4 border-b font-semibold text-gray-600">Naam</th>
                        <th class="p-4 border-b font-semibold text-gray-600">Locatie</th>
                        <th class="p-4 border-b font-semibold text-gray-600">Prijs per nacht</th>
                        <th class="p-4 border-b font-semibold text-gray-600">Eigenaar</th>
                        <th class="p-4 border-b font-semibold text-gray-600">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($huizen as $vakantiehuis)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4">{{ $vakantiehuis->naam }}</td>
                            <td class="p-4">{{ $vakantiehuis->stad }}, {{ $vakantiehuis->straatnaam }} {{ $vakantiehuis->huisnummer }}</td>
                            <td class="p-4 text-green-600 font-bold">€{{ number_format($vakantiehuis->prijs, 2) }}</td>
                            <td class="p-4">{{ $vakantiehuis->verhuurder->name ?? 'Onbekend' }}</td>
                            <td class="p-4 space-x-2">
                                <a href="{{ route('verhuurder.huizen.edit', $vakantiehuis->id) }}" class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700">Bewerken</a>
                                <a href="{{ route('admin.users.manage', $vakantiehuis->user_id) }}" class="bg-teal-600 text-white px-3 py-1 rounded hover:bg-teal-700">Beheer Eigenaar</a>
                                <form action="{{ route('admin.huizen.destroy', $vakantiehuis->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Verwijderen</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="mt-6">
            {{ $huizen->links() }}
        </div>
    </div>
</x-app-layout>
