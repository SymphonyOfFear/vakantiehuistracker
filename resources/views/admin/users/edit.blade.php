<x-app-layout>
    <div class="flex lg:flex-nowrap flex-wrap min-h-screen">

        <x-sidebar title="Gebruikersbeheer" class="lg:min-h-screen">
            <li><a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-green-600">Dashboard</a></li>
            <li><a href="{{ route('admin.users.index') }}" class="text-gray-700 hover:text-green-600">Gebruikersbeheer</a>
            </li>
            <li><a href="{{ route('admin.permissions.index') }}" class="text-gray-700 hover:text-green-600">Permissies</a>
            </li>
        </x-sidebar>


        <div class="w-full lg:w-3/4 p-8 bg-white lg:ml-auto">
            <h1 class="text-3xl font-bold mb-8">Gebruiker Bewerken</h1>

            <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="name" class="block text-lg font-bold text-gray-700 mb-2">Naam</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring focus:ring-green-500"
                        required>
                </div>

                <div class="mb-6">
                    <label for="email" class="block text-lg font-bold text-gray-700 mb-2">E-mail</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring focus:ring-green-500"
                        required>
                </div>

                <div class="mb-6">
                    <label for="role" class="block text-lg font-bold text-gray-700 mb-2">Rol</label>
                    <select id="role" name="role"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring focus:ring-green-500">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ $user->roles->contains($role->id) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                        Opslaan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
