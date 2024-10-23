<x-app-layout>
    <x-sidebar title="Instellingen">
        <li><a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-green-600">Dashboard</a></li>
        <li><a href="{{ route('admin.users.index') }}" class="text-gray-700 hover:text-green-600">Gebruikers</a></li>
        <li><a href="{{ route('admin.permissions.index') }}" class="text-gray-700 hover:text-green-600">Permissies</a>
        </li>

    </x-sidebar>

    <div class="w-full p-6 bg-white">
        <h1 class="text-2xl font-bold">Instellingen</h1>
        <p>Hier kunt u de applicatie-instellingen aanpassen.</p>
    </div>
</x-app-layout>
