<x-app-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Inloggen</h2>


            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf


                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                    <input id="email"
                        class="block mt-1 w-full border border-gray-300 rounded-md p-2 focus:ring-green-500 focus:border-green-500"
                        type="email" name="email" :value="old('email')" required autofocus />
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Wachtwoord</label>
                    <input id="password"
                        class="block mt-1 w-full border border-gray-300 rounded-md p-2 focus:ring-green-500 focus:border-green-500"
                        type="password" name="password" required autocomplete="current-password" />
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-4 flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500" name="remember">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-900">Onthoudt mij</label>
                </div>

                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-green-600 hover:underline"
                            href="{{ route('password.request') }}">Wachtwoord vergeten?</a>
                    @endif

                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
