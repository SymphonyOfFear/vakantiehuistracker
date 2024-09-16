<header class="bg-green-600 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="/" class="text-white font-semibold text-xl">Vakantiehuistracker</a>
        <nav>
            <ul class="flex space-x-4 text-white">
                <li><a href="{{ route('huizen.index') }}" class="hover:underline">Huizen</a></li>
                <li><a href="{{ route('contact.index') }}" class="hover:underline">Contact</a></li>

                @if (Auth::check())
                    <!-- Links for logged in users -->
                    <li><a href="{{ route('profile.index') }}" class="hover:underline">Mijn Profiel</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="hover:underline">Uitloggen</button>
                        </form>
                    </li>
                @else
                    <!-- Links for guests -->
                    <li><a href="{{ route('login') }}" class="hover:underline">Inloggen</a></li>
                    <li><a href="{{ route('register') }}" class="hover:underline">Registreren</a></li>
                @endif
            </ul>
        </nav>
    </div>
</header>
