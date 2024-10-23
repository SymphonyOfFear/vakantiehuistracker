<x-app-layout>
    <div class="flex lg:flex-nowrap flex-wrap min-h-screen">

        <!-- Sidebar -->
        <x-sidebar title="Permissiesbeheer" class="lg:min-h-screen">
            <li><a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-green-600">Dashboard</a></li>
            <li><a href="{{ route('admin.users.index') }}" class="text-gray-700 hover:text-green-600">Gebruikers</a></li>
            <li><a href="{{ route('admin.permissions.index') }}" class="text-gray-700 hover:text-green-600">Permissies</a>
            </li>
        </x-sidebar>

        <!-- Content -->
        <div class="w-full lg:w-3/4 p-6 bg-white lg:ml-auto">
            <h1 class="text-2xl font-bold mb-4">Rol en Permissies Beheer</h1>

            <!-- Role Selection -->
            <form action="{{ route('admin.permissions.roles') }}" method="GET">
                <label for="role" class="block text-gray-700 font-bold mb-2">Selecteer Rol</label>
                <select id="role" name="role" class="w-full border border-gray-300 rounded p-2 mb-4"
                    onchange="this.form.submit()">
                    <option value="">Kies een rol...</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ request()->get('role') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </form>

            @if (isset($selectedRole))
                <form action="{{ route('admin.permissions.update', $selectedRole->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <h2 class="text-xl font-semibold my-4">Permissies voor {{ $selectedRole->name }}</h2>

                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($permissions as $permission)
                            <div class="flex items-center">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                    @if ($selectedRole->permissions->pluck('id')->contains($permission->id)) checked @endif>
                                <span class="ml-2">{{ $permission->name }}</span>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="mt-4 bg-green-500 text-white rounded px-4 py-2">Opslaan</button>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>
