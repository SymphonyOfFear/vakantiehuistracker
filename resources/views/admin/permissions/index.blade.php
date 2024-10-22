<!-- resources/views/admin/permissions/index.blade.php -->

<x-app-layout>
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold">Beheer Toestemmingen</h1>

        <div class="my-4">
            <a href="{{ route('permissions.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Nieuwe
                Toestemming</a>
        </div>

        <table class="table-auto w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Naam</th>
                    <th class="px-4 py-2">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td class="border px-4 py-2">{{ $permission->name }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('permissions.edit', $permission->id) }}"
                                class="text-blue-500">Bewerken</a>
                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                                class="inline-block">
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
