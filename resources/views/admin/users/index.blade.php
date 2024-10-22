<!-- resources/views/admin/users/index.blade.php -->

<x-app-layout>
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold">Gebruikersbeheer</h1>

        <table class="table-auto w-full mt-4">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Naam</th>
                    <th class="px-4 py-2">E-mail</th>
                    <th class="px-4 py-2">Rollen</th>
                    <th class="px-4 py-2">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                        <td class="border px-4 py-2">{{ $user->email }}</td>
                        <td class="border px-4 py-2">{{ implode(', ', $user->roles()->pluck('name')->toArray()) }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500">Bewerken</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
