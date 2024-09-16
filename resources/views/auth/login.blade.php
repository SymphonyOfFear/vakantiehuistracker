<x-app-layout>
    <!-- Header Component -->
    <x-header />

    <div class="min-h-screen flex items-center justify-center bg-green-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <img class="mx-auto h-12 w-auto" src="{{ asset('images/logo.png') }}" alt="Vakantiehuistracker">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Log in op je account
                </h2>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email" class="sr-only">Email adres</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                            placeholder="Email adres">
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password" class="sr-only">Wachtwoord</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                            placeholder="Wachtwoord">
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mt-4">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox"
                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                            Onthoud mij
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="{{ route('password.request') }}"
                            class="font-medium text-green-600 hover:text-green-500">
                            Wachtwoord vergeten?
                        </a>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Log in
                    </button>
                </div>

                <div class="mt-2 text-sm text-gray-600 text-center">
                    Heb je nog geen account?
                    <a href="{{ route('register') }}" class="text-green-600 hover:underline">
                        Registreer hier
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer Component -->
    <x-footer />
</x-app-layout>
