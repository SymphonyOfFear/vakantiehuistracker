<x-app-layout>

    <div class="flex">
        <!-- Sidebar -->
        <x-sidebar title="Admin Dashboard" />

        <div class="w-3/4 ml-64 p-6">
            <h1 class="text-2xl font-bold">Welkom bij het Admin Dashboard</h1>
            <p>Beheer hier gebruikers, permissies, en systeeminstellingen.</p>

            <div class="grid grid-cols-3 gap-4 mt-6">
                <!-- Aantal Gebruikers -->
                <div class="bg-green-100 p-4 rounded-lg">
                    <h2 class="text-lg font-bold">Aantal Gebruikers</h2>
                    <p>{{ $users }}</p>
                </div>

                <!-- Beheerde Toestemmingen -->
                <div class="bg-green-100 p-4 rounded-lg">
                    <h2 class="text-lg font-bold">Beheerde Toestemmingen</h2>
                    <p>{{ $permissions }}</p>
                </div>

                <!-- Systeem Logs -->
                <div class="bg-green-100 p-4 rounded-lg">
                    <h2 class="text-lg font-bold">Systeem Logs</h2>
                    <p>Hier komen de systeem logs.</p>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
