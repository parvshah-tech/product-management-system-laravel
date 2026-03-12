@props(['images' => []])

<div x-data="{
    activeSlide: 0,
    slides: {{ json_encode($images) }},
    next() { this.activeSlide = (this.activeSlide + 1) % this.slides.length },
    prev() { this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length }
}"
    {{ $attributes->merge(['class' => 'relative w-full min-h-full overflow-hidden bg-gray-100 dark:bg-gray-800']) }}>

    <!-- Slides -->
    <div class="relative w-full h-full min-h-[400px]">
        @forelse($images as $index => $image)
            <div x-show="activeSlide === {{ $index }}" x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform scale-105"
                x-transition:enter-end="opacity-100 transform scale-100" class="absolute inset-0 w-full h-full">
                <img src="{{ asset('storage/' . $image) }}" class="w-full h-full object-cover"
                    alt="Product Image {{ $index + 1 }}">
            </div>
        @empty
            <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                <svg class="w-16 h-16 opacity-20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                <span class="font-medium">No Image Available</span>
            </div>
        @endforelse
    </div>

    <!-- Navigation Arrows -->
    @if (count($images) > 1)
        <button @click="prev()"
            class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 backdrop-blur-md p-2 rounded-full text-white transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button @click="next()"
            class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 backdrop-blur-md p-2 rounded-full text-white transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <!-- Dots Indicator -->
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2">
            @foreach ($images as $index => $image)
                <button @click="activeSlide = {{ $index }}"
                    :class="activeSlide === {{ $index }} ? 'w-8 bg-white' : 'w-2 bg-white/50'"
                    class="h-2 rounded-full transition-all duration-300"></button>
            @endforeach
        </div>
    @endif
</div>
