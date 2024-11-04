<x-app-layout>
    <div class="flex lg:flex-nowrap flex-wrap min-h-screen bg-gray-100">
        <x-sidebar title="Admin Dashboard">

        </x-sidebar>

        <div class="w-full p-6 bg-white lg:ml-auto">
            <h1 class="text-2xl font-bold mb-4">Welkom bij het Admin Dashboard</h1>
            <p>Beheer gebruikers, permissies en instellingen.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-4 bg-gray-100 rounded-lg shadow">
                    <h2 class="text-lg font-bold mb-2">Gebruikers</h2>
                    <p>Totaal aantal gebruikers: {{ $users }}</p>
                </div>
                <div class="p-4 bg-gray-100 rounded-lg shadow">
                    <h2 class="text-lg font-bold mb-2">Permissies</h2>
                    <p>Totaal aantal permissies: {{ $permissions }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
