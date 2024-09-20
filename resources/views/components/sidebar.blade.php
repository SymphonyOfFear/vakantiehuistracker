<div {{ $attributes->merge(['class' => 'bg-gray-100 w-1/4 h-screen shadow-lg p-4']) }}>
    <!-- Sidebar Titel -->
    <div class="text-lg font-semibold text-gray-800 mb-4">
        {{ $title ?? 'Menu' }}
    </div>

    <!-- Sidebar Items -->
    <ul class="space-y-4">
        {{ $slot }}
    </ul>
</div>
