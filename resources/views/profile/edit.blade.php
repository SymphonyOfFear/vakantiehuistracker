<x-app-layout>



    <div class="min-h-screen flex flex-col bg-green-100">
        <div class="container mx-auto py-16 flex-grow flex justify-center">
            <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow-md">
                <h1 class="text-3xl font-semibold mb-6 text-center text-gray-800">Bewerk Profiel</h1>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')


                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Naam</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:border-green-500 focus:ring-green-500">
                    </div>


                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:border-green-500 focus:ring-green-500">
                    </div>


                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Nieuw Wachtwoord</label>
                        <input type="password" id="password" name="password"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:border-green-500 focus:ring-green-500"
                            placeholder="Laat leeg om hetzelfde te houden">
                    </div>


                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Bevestig
                            Wachtwoord</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:border-green-500 focus:ring-green-500"
                            placeholder="Herhaal nieuw wachtwoord">
                    </div>


                    <div class="flex justify-between mt-6">
                        <a href="{{ route('profile.index') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Annuleren</a>
                        <button type="submit"
                            class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                            Opslaan
                        </button>
                    </div>
                </form>
            </div>
        </div>



    </div>
</x-app-layout>
