<article
    {{ $attributes->merge(['class' => 'max-w-6xl mx-auto bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 shadow-xl overflow-hidden']) }}>
    <!-- Added items-stretch to make both columns equal height -->
    <div class="flex flex-col lg:flex-row lg:items-stretch">

        <!-- Left: Slider -->
        <div class="w-full lg:w-1/2 flex">
            @php
                $images = is_string($product->feature_images)
                    ? json_decode($product->feature_images, true)
                    : $product->feature_images ?? [];
                if ($product->gallery_image) {
                    array_unshift($images, $product->gallery_image);
                }
            @endphp

            <!-- Component must fill the available height -->
            <x-product-slider :images="$images" class="flex-1" />
        </div>

        <!-- Right: Info -->
        <div class="w-full lg:w-1/2 p-8 lg:p-12 flex flex-col justify-between">
            <div>
                <nav class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-indigo-600 mb-6">
                    <span>{{ $product->category->name ?? $product->category }}</span>
                    <span class="text-gray-300">/</span>
                    <span class="text-gray-500">{{ $product->subcategory->name ?? $product->subcategory }}</span>
                </nav>

                <h1 class="text-3xl sm:text-4xl font-black text-gray-900 dark:text-white mb-4">
                    {{ $product->name }}
                </h1>

                <div class="flex items-center gap-4 mb-8">
                    <span
                        class="text-3xl font-black text-gray-900 dark:text-white">₹{{ number_format($product->sale_price, 2) }}</span>
                    @if ($product->sale_price < $product->price)
                        <span
                            class="text-xl text-gray-400 line-through decoration-red-500/50">₹{{ number_format($product->price, 2) }}</span>
                    @endif
                </div>

                <div class="prose prose-indigo dark:prose-invert">
                    <h4 class="text-sm font-bold uppercase tracking-wider mb-2 dark:text-white">Description</h4>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        {!! nl2br(e($product->description)) !!}
                    </p>
                </div>
            </div>

            <!-- Buttons stay at the very bottom -->
            <div
                class="mt-12 pt-8 border-t border-gray-100 dark:border-gray-800 flex flex-col sm:flex-row gap-4 items-center justify-between">
                <a href="/products"
                    class="flex items-center text-sm font-bold text-gray-500 hover:text-indigo-600 group">
                    <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Browse More
                </a>
                @if (Auth::id() == $product->user_id)
                    <a href="/products/{{ $product->id }}/edit"
                        class="w-full sm:w-auto px-8 py-3 text-sm font-bold text-white bg-indigo-600 rounded-2xl hover:bg-indigo-700 shadow-lg shadow-indigo-200 dark:shadow-none text-center transition-all">
                        Edit Product
                    </a>
                @endif
            </div>
        </div>
    </div>
</article>
