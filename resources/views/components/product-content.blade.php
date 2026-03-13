<div class="max-w-6xl mx-auto shadow-xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-800">

    {{-- Main Product Card (Top Section) --}}
    <article class="bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800">
        <div class="flex flex-col lg:flex-row lg:items-stretch">

            <!-- Left: Slider -->
            <div class="w-full lg:w-1/2 flex border-r border-gray-100 dark:border-gray-800">
                @php
                    $images = is_string($product->feature_images)
                        ? json_decode($product->feature_images, true)
                        : $product->feature_images ?? [];
                    if ($product->gallery_image) {
                        array_unshift($images, $product->gallery_image);
                    }
                @endphp
                <x-product-slider :images="$images" class="flex-1" />
            </div>

            <!-- Right: Info -->
            <div class="w-full lg:w-1/2 p-8 lg:p-12 flex flex-col justify-between">
                <div>
                    <nav
                        class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-indigo-600 mb-6">
                        <span>{{ $product->category->parent->name ?? $product->category->name }}</span>
                        <span class="text-gray-300">/</span>
                        <span class="text-gray-500">{{ $product->category->name }}</span>
                    </nav>

                    <div class="flex flex-col gap-1 mb-4">
                        <h1 class="text-3xl sm:text-4xl font-black text-gray-900 dark:text-white leading-tight">
                            {{ $product->name }}
                        </h1>
                        <div class="flex items-center gap-2">
                            <span
                                class="px-2 py-0.5 rounded bg-gray-100 dark:bg-gray-800 text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">
                                Item #{{ $product->sku }}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 mb-8">
                        <span
                            class="text-3xl font-black text-gray-900 dark:text-white">₹{{ number_format($product->sale_price, 2) }}</span>
                        @if ($product->sale_price < $product->price)
                            <span
                                class="text-xl text-gray-400 line-through decoration-red-500/50">₹{{ number_format($product->price, 2) }}</span>
                        @endif
                    </div>

                    <div class="prose prose-indigo dark:prose-invert">
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed text-sm">
                            {!! nl2br(e($product->short_description)) !!}
                        </p>
                    </div>
                </div>

                <div
                    class="mt-12 pt-8 border-t border-gray-100 dark:border-gray-800 flex flex-col sm:flex-row gap-4 items-center justify-between">
                    <a href="/products"
                        class="flex items-center text-sm font-bold text-gray-500 hover:text-indigo-600 group">
                        <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Browse More
                    </a>
                    <a href="/products/{{ $product->id }}/edit"
                        class="w-full sm:w-auto px-8 py-3 text-sm font-bold text-white bg-indigo-600 rounded-2xl hover:bg-indigo-700 shadow-lg shadow-indigo-200 dark:shadow-none text-center transition-all">
                        Edit Product
                    </a>
                </div>
            </div>
        </div>
    </article>

    {{-- Extension Section (Bottom Section) --}}
    <section class="bg-gray-50/50 dark:bg-gray-900/50 p-8 lg:p-12">
        <div class="max-w-4xl">
            <h2
                class="text-xl font-black text-gray-900 dark:text-white mb-6 flex items-center gap-3 italic uppercase tracking-tight">
                <span class="w-8 h-1 bg-indigo-600 rounded-full"></span>
                Full Specifications
            </h2>

            <div class="prose prose-indigo dark:prose-invert max-w-none">
                <div class="text-gray-600 dark:text-gray-300 leading-loose text-base">
                    {!! nl2br(e($product->description)) !!}
                </div>
            </div>
        </div>
    </section>
</div>
