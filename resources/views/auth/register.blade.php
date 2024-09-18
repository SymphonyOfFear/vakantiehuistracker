<x-app-layout>
    <!-- Header Component -->
    <x-header />

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center bg-green-100">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-semibold text-center text-green-600 mb-6">Registreer je voor Vakantiehuistracker
            </h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Naam')" />
                    <x-text-input id="name"
                        class="block mt-1 w-full border-green-500 focus:border-green-600 focus:ring-green-500 rounded-md shadow-sm"
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('E-mail')" />
                    <x-text-input id="email"
                        class="block mt-1 w-full border-green-500 focus:border-green-600 focus:ring-green-500 rounded-md shadow-sm"
                        type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Wachtwoord')" />
                    <x-text-input id="password"
                        class="block mt-1 w-full border-green-500 focus:border-green-600 focus:ring-green-500 rounded-md shadow-sm"
                        type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <x-input-label for="password_confirmation" :value="__('Bevestig wachtwoord')" />
                    <x-text-input id="password_confirmation"
                        class="block mt-1 w-full border-green-500 focus:border-green-600 focus:ring-green-500 rounded-md shadow-sm"
                        type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between">
                    <a class="text-sm text-green-600 hover:text-green-700" href="{{ route('login') }}">
                        {{ __('Al geregistreerd?') }}
                    </a>

                    <x-primary-button class="ml-4 bg-green-600 hover:bg-green-700">
                        {{ __('Registreer') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer Component -->
    <x-footer />
</x-app-layout>
