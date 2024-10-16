<x-app-layout>



    <div class="min-h-screen flex flex-col bg-green-100">
        <div class="container mx-auto py-8 flex-grow flex justify-center items-center">
            <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
                <h1 class="text-2xl font-semibold mb-4 text-center text-gray-800">Mijn Profiel</h1>

                <div class="mb-4">
                    <label class="block font-semibold text-gray-700">Naam:</label>
                    <p class="text-gray-600">{{ Auth::user()->name }}</p>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold text-gray-700">Email:</label>
                    <p class="text-gray-600">{{ Auth::user()->email }}</p>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold text-gray-700">Wachtwoord:</label>
                    <p class="text-gray-600">****</p>
                </div>


                <div class="text-center mt-4">
                    <a href="{{ route('profile.edit') }}"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        Bewerk profiel
                    </a>
                </div>
            </div>
        </div>



    </div>
</x-app-layout>
