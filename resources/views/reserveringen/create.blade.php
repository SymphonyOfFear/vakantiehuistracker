    <x-app-layout>
        <x-header />

        <div class="min-h-screen bg-green-100 py-16">
            <div class="container mx-auto">
                <h1 class="text-3xl font-semibold text-gray-700 mb-6">Maak een Reservering</h1>

                <form action="{{ route('reserveringen.store') }}" method="POST">
                    @csrf

                    <!-- Select vacation house -->
                    <div class="mb-4">
                        <label for="vakantiehuis" class="block text-gray-700">Vakantiehuis:</label>
                        <select name="vakantiehuis_id" id="vakantiehuis" class="w-full px-4 py-2 border rounded-md">
                            @foreach ($huizen as $huis)
                                <option value="{{ $huis->id }}">{{ $huis->naam }} - {{ $huis->locatie }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Start date -->
                    <div class="mb-4">
                        <label for="startdatum" class="block text-gray-700">Startdatum:</label>
                        <input type="date" name="startdatum" id="startdatum"
                            class="w-full px-4 py-2 border rounded-md" required>
                    </div>

                    <!-- End date -->
                    <div class="mb-4">
                        <label for="einddatum" class="block text-gray-700">Einddatum:</label>
                        <input type="date" name="einddatum" id="einddatum" class="w-full px-4 py-2 border rounded-md"
                            required>
                    </div>

                    <!-- Submit button -->
                    <div class="mt-6">
                        <button type="submit"
                            class="w-full px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                            Bevestig Reservering
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <x-footer />
    </x-app-layout>
