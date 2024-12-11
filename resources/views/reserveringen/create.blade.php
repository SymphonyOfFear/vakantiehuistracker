<x-app-layout>
    <div class="min-h-screen bg-gradient-to-r from-green-100 to-green-200 py-16">
        <div class="container mx-auto px-6 lg:px-0">
            <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Nieuwe Reservering</h1>

            <!-- Debugging voor validatiefouten -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                    <strong>Er zijn problemen met uw invoer:</strong>
                    <ul class="mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white p-8 lg:p-12 rounded-lg shadow-xl max-w-2xl mx-auto">
                <form action="{{ route('reserveringen.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Vakantiehuis -->
                    <div>
                        <label for="vakantiehuis_id" class="block text-sm font-semibold text-gray-700">Vakantiehuis</label>
                        <select name="vakantiehuis_id" id="vakantiehuis_id" 
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                            <option value="">Selecteer een vakantiehuis</option>
                            @foreach ($vakantiehuizen as $vakantiehuis)
                                <option value="{{ $vakantiehuis->id }}" {{ old('vakantiehuis_id') == $vakantiehuis->id ? 'selected' : '' }}>
                                    {{ $vakantiehuis->naam }} - €{{ $vakantiehuis->prijs }}
                                </option>
                            @endforeach
                        </select>
                        @error('vakantiehuis_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Startdatum -->
                    <div>
                        <label for="begindatum" class="block text-sm font-semibold text-gray-700">Startdatum</label>
                        <input type="date" name="begindatum" id="begindatum" 
                               class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" 
                               value="{{ old('begindatum') }}">
                        @error('begindatum')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Einddatum -->
                    <div>
                        <label for="einddatum" class="block text-sm font-semibold text-gray-700">Einddatum</label>
                        <input type="date" name="einddatum" id="einddatum" 
                               class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" 
                               value="{{ old('einddatum') }}">
                        @error('einddatum')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" 
                                class="w-full lg:w-auto px-8 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition ease-in-out duration-200 shadow-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            Reservering Aanmaken
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
