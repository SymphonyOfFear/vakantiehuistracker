<form action="{{ route('admin.users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')


    <div class="mb-4">
        <label for="name" class="block text-gray-700">Naam:</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border-gray-300">
    </div>

    <div class="mb-4">
        <label for="email" class="block text-gray-700">E-mail:</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border-gray-300">
    </div>


    <div class="mb-4">
        <label for="role" class="block text-gray-700">Rol:</label>
        <select name="role" class="w-full border-gray-300">
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
    </div>


    <div class="mb-4">
        <label for="permissions" class="block text-gray-700">Permissies:</label>
        <div class="grid grid-cols-2">
            @foreach ($permissions as $permission)
                <label class="inline-flex items-center">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                        {{ $user->roles->first()->permissions->contains($permission->id) ? 'checked' : '' }}>
                    <span class="ml-2">{{ $permission->name }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Opslaan</button>
</form>
