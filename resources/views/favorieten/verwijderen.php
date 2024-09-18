<x-app-layout>
    <x-header />

    <div class="min-h-screen bg-green-100 py-16">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">Verwijder Favoriet</h1>

            <!-- This form is usually rendered dynamically in other views (e.g., index or show page) -->
            <form action="{{ route('favorieten.verwijderen', $huis->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                    Verwijder uit favorieten
                </button>
            </form>
        </div>
    </div>

    <x-footer />
</x-app-layout>
