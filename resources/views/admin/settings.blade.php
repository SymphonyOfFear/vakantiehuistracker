<!-- resources/views/admin/settings.blade.php -->

<x-app-layout>
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold">Instellingen</h1>

        <form action="{{ route('settings.update') }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="site_name" class="block text-sm font-medium text-gray-700">Site Naam</label>
                <input type="text" name="site_name" id="site_name" class="mt-1 block w-full"
                    value="{{ $settings->site_name ?? '' }}">
            </div>

            <div class="mb-4">
                <label for="site_email" class="block text-sm font-medium text-gray-700">Site E-mail</label>
                <input type="email" name="site_email" id="site_email" class="mt-1 block w-full"
                    value="{{ $settings->site_email ?? '' }}">
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Opslaan</button>
        </form>
    </div>
</x-app-layout>
