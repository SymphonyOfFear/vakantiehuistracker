<x-app-layout>
    <x-header />

    <div class="min-h-screen bg-green-100 py-16">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">Verhuurder Dashboard</h1>
            <p>Welkom bij het verhuurdersdashboard. Hier kun je je vakantiehuizen beheren, reserveringen bekijken en
                feedback.</p>
            <a href="{{ route('verhuurder.huizen.index') }}"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                Huis Index
            </a>
        </div>
    </div>
    <x-footer />
</x-app-layout>
