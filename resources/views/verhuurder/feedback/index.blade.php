<x-app-layout>
    <x-header />


    <div class="min-h-screen bg-green-100 py-16">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">Mijn Vakantiehuizen</h1>

            <!-- List of vacation houses added by the landlord -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- @foreach ($feedbacks as $feedback)
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h3 class="text-xl font-bold text-gray-800">{{ $feedback->naam }}</h3>
                        <p class="text-green-600 font-semibold">€ {{ $feedback->feedbackp }}</p>
                        {{-- <a href="{{ route('verhuurder.huizen.show', $huisje->id) }}"
                            class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                            Bekijk details
                        </a>
                        <a href="{{ route('verhuurder.huizen.bewerken', $huisje->id) }}"
                            class="mt-4 inline-block bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                            Bewerk Vakantiehuis
                        </a>
                        <form action="{{ route('verhuurder.huizen.destroy', $huisje->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-red-600 hover:text-red-900 focus:outline-none focus:border-red-700 focus:ring-red active:text-red-700 transition ease-in-out duration-150">
                                Delete
                            </button>
                        </form>

                    </div>
                @endforeach 
                --}}
            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
