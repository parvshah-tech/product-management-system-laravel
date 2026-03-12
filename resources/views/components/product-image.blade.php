@props(['path', 'alt' => 'Post image'])

<div {{ $attributes->merge(['class' => 'relative w-full overflow-hidden bg-gray-100 dark:bg-gray-800']) }}>
    <img src="{{ asset('storage/' . $path) }}" alt="{{ $alt }}"
        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" loading="lazy">
    {{-- Subtle Overlay for better contrast --}}
    <div class="absolute inset-0 bg-linear-to-t from-black/20 to-transparent"></div>
</div>
