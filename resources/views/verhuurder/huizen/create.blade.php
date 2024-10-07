<!-- create.blade.php -->
<x-app-layout>
    <x-header />

    <div class="flex">
        <!-- Sidebar -->
        <x-sidebar title="Huizenbeheer">
            <li><a href="{{ route('verhuurder.huizen.index') }}" class="text-gray-700 hover:text-green-600">Mijn
                    Huizen</a></li>
            <li><a href="{{ route('verhuurder.huizen.create') }}" class="text-gray-700 hover:text-green-600">Voeg Huis
                    Toe</a></li>
        </x-sidebar>

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">Voeg Nieuw Vakantiehuis Toe</h1>

            <!-- Create Form -->
            <form action="{{ route('verhuurder.huizen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Form Inputs: Name, Price, Description, etc. -->
                @include('verhuurder.huizen.partials.form', ['vakantiehuis' => null])



            </form>
        </div>
    </div>

    <x-footer />
</x-app-layout>
