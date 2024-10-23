<x-app-layout>
    <div class="flex lg:flex-nowrap flex-wrap min-h-screen">

        <x-sidebar title="Gebruikersbeheer" class="lg:min-h-screen">
            <li><a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-green-600">Dashboard</a></li>
            <li><a href="{{ route('admin.users.index') }}" class="text-gray-700 hover:text-green-600">Gebruikersbeheer</a>
            </li>
            <li><a href="{{ route('admin.permissions.index') }}" class="text-gray-700 hover:text-green-600">Permissies</a>
            </li>
        </x-sidebar>


        <div class="w-full lg:w-3/4 p-6 bg-white lg:ml-auto">
            <h1 class="text-2xl font-bold mb-6">Gebruikers</h1>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-gray-100 border-collapse">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 border text-left">Naam</th>
                            <th class="px-6 py-3 border text-left">E-mail</th>
                            <th class="px-6 py-3 border text-left">Rol</th>
                            <th class="px-6 py-3 border text-center">Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="bg-white">
                                <td class="border px-6 py-3">{{ $user->name }}</td>
                                <td class="border px-6 py-3">{{ $user->email }}</td>
                                <td class="border px-6 py-3">{{ implode(', ', $user->roles->pluck('name')->toArray()) }}
                                </td>
                                <td class="border px-6 py-3 text-center">
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="text-blue-500 hover:underline">Bewerken</a>
                                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}"
                                        class="inline-block ml-4">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Verwijderen</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
