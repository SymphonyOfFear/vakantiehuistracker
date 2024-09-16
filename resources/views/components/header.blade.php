<header class="bg-green-600 text-white p-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <div class="text-xl font-bold">
            <a href="/" class="text-white">Vakantiehuistracker</a>
        </div>

        <!-- Navigation Links -->
        <nav class="space-x-4 flex items-center">
            <a href="{{ route('huizen.index') }}" class="hover:text-green-300">Huizen</a>


            @auth
                @if (Auth::user()->is_verhuurder)
                    <a href="{{ route('verhuurder.dashboard') }}" class="hover:text-green-300">Dashboard</a>
                    <a href="{{ route('verhuurder.huis.toevoegen') }}" class="hover:text-green-300">Huis Toevoegen</a>
                @endif
            @endauth

            <!-- Algemene pagina's -->
            <a href="{{ route('contact.index') }}" class="hover:text-green-300">Contact</a>

        </nav>


        <div>
            @auth
                <!-- Dropdown voor ingelogde gebruiker -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:text-green-300">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Log Out -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @else
                <!-- Login en Registratie links -->
                <a href="{{ route('login') }}" class="text-white hover:text-green-300">Inloggen</a>
                <a href="{{ route('register') }}" class="text-white hover:text-green-300">Registreren</a>
            @endauth
        </div>
    </div>
</header>
