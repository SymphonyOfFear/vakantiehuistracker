<x-app-layout>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <x-sidebar title="Admin Dashboard">
            <li><a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-green-600">Dashboard</a></li>
            <li><a href="{{ route('admin.users.index') }}" class="text-gray-700 hover:text-green-600">Gebruikersbeheer</a>
            </li>
            <li><a href="{{ route('admin.permissions.index') }}" class="text-gray-700 hover:text-green-600">Toestemmingen
                    Beheren</a></li>
            <li><a href="{{ route('admin.settings') }}" class="text-gray-700 hover:text-green-600">Instellingen</a></li>
        </x-sidebar>

        <div class="w-full bg-white p-6">
            <h1 class="text-2xl font-bold">Welkom bij het Admin Dashboard</h1>
            <p>Beheer hier gebruikers, permissies, en systeeminstellingen.</p>


            <div class="mt-6">
                <h2 class="text-xl font-semibold">Overzicht</h2>
                <div class="grid grid-cols-3 gap-6 mt-4">
                    <div class="bg-green-100 p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-bold">Aantal Gebruikers</h3>
                        <p class="text-3xl">{{ $users }}</p>
                    </div>

                    <div class="bg-green-100 p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-bold">Beheerde Toestemmingen</h3>
                        <p class="text-3xl">{{ $permissions }}</p>
                    </div>

                    <div class="bg-green-100 p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-bold">Systeem Logs</h3>
                        <p class="text-3xl"></p>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
