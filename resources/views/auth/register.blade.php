<x-app-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Registreren</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf


                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Naam</label>
                    <input id="name"
                        class="block mt-1 w-full border border-gray-300 rounded-md p-2 focus:ring-green-500 focus:border-green-500"
                        type="text" name="name" :value="old('name')" required autofocus />
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                    <input id="email"
                        class="block mt-1 w-full border border-gray-300 rounded-md p-2 focus:ring-green-500 focus:border-green-500"
                        type="email" name="email" :value="old('email')" required />
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Wachtwoord</label>
                    <input id="password"
                        class="block mt-1 w-full border border-gray-300 rounded-md p-2 focus:ring-green-500 focus:border-green-500"
                        type="password" name="password" required autocomplete="new-password" />
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Wachtwoord
                        Bevestigen
                    </label>
                    <input id="password_confirmation"
                        class="block mt-1 w-full border border-gray-300 rounded-md p-2 focus:ring-green-500 focus:border-green-500"
                        type="password" name="password_confirmation" required />
                </div>

                <!-- Register Button -->
                <div class="flex items-center justify-between">
                    <a class="text-sm text-green-600 hover:underline" href="{{ route('login') }}">Al geregistreerd?</a>

                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                        Registreren
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
