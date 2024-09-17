<x-app-layout>
    <x-header />

    <div class="min-h-screen bg-green-100 py-16">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">Voeg Favoriet Toe</h1>

            <!-- This form is usually rendered dynamically in other views (e.g., show page) -->
            <form action="{{ route('favorieten.toevoegen') }}" method="POST">
                @csrf
                <input type="hidden" name="huis_id" value="{{ $huis->id }}">

                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                    Voeg toe aan favorieten
                </button>
            </form>
        </div>
    </div>

    <x-footer />
</x-app-layout>
