@props(['title', 'subtitle' => null])

<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
            {{ $title }}
        </h1>
        @if ($subtitle)
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                {{ $subtitle }}
            </p>
        @endif
    </div>
    {{ $slot }} {{-- For buttons like "Create Post" --}}
</div>
