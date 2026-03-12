@props(['product'])

<div
    {{ $attributes->merge(['class' => 'mx-auto group bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col overflow-hidden w-full max-w-[300px]']) }}>

    <!-- Image Section -->
    <div class="relative aspect-[4/3] overflow-hidden bg-gray-50 dark:bg-gray-800/50 w-full">
        @if ($product->gallery_image)
            <img src="{{ asset('storage/' . $product->gallery_image) }}" alt="{{ $product->name }}"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        @else
            <!-- Added w-full and h-full here to force the placeholder to match the card width -->
            <div
                class="w-full h-full flex items-center justify-center text-gray-400 font-medium text-xs border-b border-gray-100 dark:border-gray-800">
                <div class="flex flex-col items-center gap-2">
                    <svg class="w-8 h-8 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span>No Image</span>
                </div>
            </div>
        @endif

        @if ($product->sale_price < $product->price)
            <div
                class="absolute top-3 left-3 bg-red-600 text-white text-[10px] font-black px-2.5 py-1 rounded-lg shadow-lg uppercase tracking-wider">
                Sale
            </div>
        @endif
    </div>

    <!-- Content Section -->
    <div class="p-5 flex flex-col flex-1">
        <!-- Category & Sub -->
        <div class="flex items-center gap-2 mb-2">
            <span class="text-[10px] font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">
                {{ $product->category->name ?? $product->category }}
            </span>
            <span class="w-1 h-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
            <span
                class="text-[10px] text-gray-500 font-medium italic">{{ $product->subcategory->name ?? $product->subcategory }}</span>
        </div>

        <!-- Title -->
        <h3
            class="text-base font-bold text-gray-900 dark:text-white mb-2 line-clamp-1 group-hover:text-indigo-600 transition-colors">
            {{ $product->name }}
        </h3>

        <!-- Price Section -->
        <div class="flex items-baseline gap-2 mb-5">
            <span class="text-lg font-black text-gray-900 dark:text-white">
                ₹{{ number_format($product->sale_price, 2) }}
            </span>
            @if ($product->sale_price < $product->price)
                <span class="text-xs text-gray-400 line-through decoration-red-400/40">
                    ₹{{ number_format($product->price, 2) }}
                </span>
            @endif
        </div>

        <!-- Action Row -->
        <div class="mt-auto space-y-3">
            <div class="flex items-center gap-2">
                <a href="/products/{{ $product->id }}"
                    class="flex-1 text-center py-2.5 bg-indigo-600 text-white rounded-xl text-xs font-bold hover:bg-indigo-700 shadow-md shadow-indigo-100 dark:shadow-none transition-all active:scale-95">
                    View Product
                </a>
                <a href="/products/{{ $product->id }}/edit"
                    class="p-2.5 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 rounded-xl hover:bg-amber-500 hover:text-white transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                        </path>
                    </svg>
                </a>
            </div>

            <form method="POST" action="/products/{{ $product->id }}"
                onsubmit="return confirm('Permanently delete this product?')" class="w-full text-center">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="text-[10px] font-bold text-gray-400 hover:text-red-500 uppercase tracking-widest transition-colors">
                    Remove from Store
                </button>
            </form>
        </div>
    </div>
</div>
