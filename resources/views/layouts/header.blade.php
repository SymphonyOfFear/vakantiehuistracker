<header class="bg-green-600 text-white p-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">

        <div class="text-xl font-bold">
            <a href="{{ route('home') }}" class="text-white">Vakantiehuistracker</a>
        </div>

        <nav class="space-x-4">
            <a href="{{ route('huizen.index') }}" class="hover:text-green-300">Huizen</a>
            @auth
                @if (Auth::user()->hasRole('verhuurder'))
                    <a href="{{ route('verhuurder.dashboard') }}" class="hover:text-green-300">Dashboard</a>
                @elseif (Auth::user()->hasRole('huurder'))
                    <a href="{{ route('huurder.dashboard') }}" class="hover:text-green-300">Dashboard</a>
                @elseif (Auth::user()->hasRole('admin'))
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-green-300">Dashboard</a>
                @endif
                <div class="relative inline-block">
                    <button aria-haspopup="true" class="inline-flex items-center focus:outline-none hover:text-green-300">
                        {{ Auth::user()->name }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.121 12l4.243 4.243a1 1 0 001.415 0l4.243-4.243" />
                        </svg>
                    </button>
                    <ul
                        class="absolute hidden bg-white text-gray-800 shadow-md rounded-lg mt-2 right-0 w-48 profile-dropdown">
                        <li><a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profiel</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100">Uitloggen</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="hover:text-green-300">Inloggen</a>
                <a href="{{ route('register') }}" class="hover:text-green-300">Registreren</a>
            @endauth
        </nav>
    </div>
</header>
