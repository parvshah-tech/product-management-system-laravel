@extends('layouts.header')

@section('content')
    <div class="flex items-center flex-col px-6 lg:px-8">
        <x-header title="Update Product" subtitle="Updating: {{ $product->name }}" />

        <div class="flex-1 flex items-start justify-center overflow-hidden pt-2">
            <div
                class="w-full max-w-5xl bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-xl overflow-hidden">
                <form action="/products/{{ $product->id }}" method="POST" onsubmit="return validateForm()"
                    enctype="multipart/form-data" class="flex flex-col h-full">
                    @csrf
                    @method('PUT')

                    <!-- Main Two-Column Body -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-2 p-8 overflow-y-auto max-h-[65vh]">

                        <!-- Left Column: Text Info -->
                        <div class="space-y-1">
                            <x-form-input name="name" label="Product Name" placeholder="Enter product name..."
                                :value="$product->name">
                                <x-slot name="error">
                                    <p class="mt-1 text-[11px] font-medium text-red-600" id="name-error"></p>
                                </x-slot>
                            </x-form-input>

                            <x-form-input name="short_description" label="Short Description"
                                placeholder="Enter short description..." :value="$product->short_description">
                                <x-slot name="error">
                                    <p class="mt-1 text-[11px] font-medium text-red-600" id="short_description-error"></p>
                                </x-slot>
                            </x-form-input>

                            <x-form-textarea name="description" label="Product Description" placeholder="Describe..."
                                rows="4">
                                {{ $product->description }}
                                <x-slot name="error">
                                    <p class="mt-1 text-[11px] font-medium text-red-600" id="description-error"></p>
                                </x-slot>
                            </x-form-textarea>

                            <div class="grid grid-cols-2 gap-4">
                                <x-form-input name="price" label="Price" type="number" step="0.01" :value="$product->price">
                                    <x-slot name="error">
                                        <p class="mt-1 text-[11px] font-medium text-red-600" id="price-error"></p>
                                    </x-slot>
                                </x-form-input>

                                <x-form-input name="sale_price" label="Sale Price" type="number" step="0.01"
                                    :value="$product->sale_price">
                                    <x-slot name="error">
                                        <p class="mt-1 text-[11px] font-medium text-red-600" id="sale_price-error"></p>
                                    </x-slot>
                                </x-form-input>
                            </div>
                        </div>

                        <!-- Right Column: Media Uploads -->
                        <div
                            class="space-y-4 bg-gray-50/50 dark:bg-gray-800/30 p-5 rounded-xl border border-gray-100 dark:border-gray-800">

                            <div class="grid grid-cols-2 gap-4">
                                <x-form-input name="category" label="Category" type="text" :value="$product->category" readonly
                                    class="cursor-not-allowed" />
                                <x-form-input name="subcategory" label="Subcategory" type="text" :value="$product->subcategory"
                                    readonly class="cursor-not-allowed" />
                            </div>

                            <h3 class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Product Media</h3>

                            <x-form-input name="gallery_image" label="Main Gallery Image" type="file" accept="image/*">
                                <x-slot name="error">
                                    <p class="mt-1 text-[11px] font-medium text-red-600" id="gallery_image-error"></p>
                                </x-slot>
                            </x-form-input>

                            @if ($product->gallery_image)
                                <div class="mt-4">
                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Current Gallery
                                        Image:</p>
                                    <img src="{{ asset('storage/' . $product->gallery_image) }}" alt="Post Image"
                                        class="w-full h-auto rounded-lg border border-gray-300">
                                </div>
                            @endif

                            <x-form-input name="feature_images[]" label="Additional Features" type="file"
                                accept="image/*" multiple>
                                <x-slot name="error">
                                    <p class="mt-1 text-[11px] font-medium text-red-600" id="feature_images-error"></p>
                                </x-slot>
                            </x-form-input>

                            @if ($product->feature_images && count($product->feature_images) > 0)
                                <div class="mt-4">
                                    <p
                                        class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 uppercase tracking-wider">
                                        Current Feature Images:
                                    </p>

                                    <!-- Hidden input to store paths of images to be deleted -->
                                    <input type="hidden" name="remove_feature_images" id="remove_feature_images"
                                        value="[]">

                                    <div class="grid grid-cols-2 gap-3">
                                        @foreach ($product->feature_images as $index => $image)
                                            <div id="feat-img-{{ $index }}"
                                                class="relative aspect-square overflow-hidden rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-800 group">

                                                <img src="{{ asset('storage/' . $image) }}" alt="Feature Image"
                                                    class="w-full h-full object-cover">

                                                <!-- Remove Button Overlay -->
                                                <button type="button"
                                                    onclick="markForRemoval('{{ $image }}', 'feat-img-{{ $index }}')"
                                                    class="absolute top-2 right-2 bg-red-600 text-white p-1.5 rounded-lg shadow-lg opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-700">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif


                        </div>
                    </div>

                    <!-- Sticky Bottom Action Bar -->
                    <div
                        class="bg-gray-50 dark:bg-gray-800/50 px-8 py-4 border-t border-gray-200 dark:border-gray-800 flex items-center justify-end gap-4">
                        <a href="/products"
                            class="text-sm font-bold text-gray-500 hover:text-gray-700 dark:hover:text-white transition-colors">
                            Cancel
                        </a>
                        <x-form-button class="shadow-lg shadow-indigo-200 dark:shadow-none px-10">
                            Update Product
                        </x-form-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    function validateForm() {
        let isValid = true;

        const name = document.querySelector('input[name="name"]').value.trim();
        const short_description = document.querySelector('input[name="short_description"]').value.trim();
        const description = document.querySelector('textarea[name="description"]').value.trim();
        const price = document.querySelector('input[name="price"]').value.trim();
        const sale_price = document.querySelector('input[name="sale_price"]').value.trim();

        if (name === '') {
            document.getElementById('name-error').textContent = 'Name is required.';
            isValid = false;
        } else if (name.length < 3) {
            document.getElementById('name-error').textContent = 'Name must be at least 3 characters long.';
            isValid = false;
        } else {
            document.getElementById('name-error').textContent = '';
        }

        if (short_description === '') {
            document.getElementById('short_description-error').textContent = 'Short description is required.';
            isValid = false;
        } else if (short_description.length < 5 || short_description.length > 255) {
            document.getElementById('short_description-error').textContent =
                'Short description must be between 5 and 255 characters long.';
            isValid = false;
        } else {
            document.getElementById('short_description-error').textContent = '';
        }

        if (description === '') {
            document.getElementById('description-error').textContent = 'Description is required.';
            isValid = false;
        } else if (description.length < 5 || description.length > 500) {
            document.getElementById('description-error').textContent =
                'Description must be between 5 and 500 characters long.';
            isValid = false;
        } else {
            document.getElementById('description-error').textContent = '';
        }

        if (price === '') {
            document.getElementById('price-error').textContent = 'Price is required.';
            isValid = false;
        } else if (isNaN(price) || parseFloat(price) <= 0) {
            document.getElementById('price-error').textContent = 'Price must be a positive number.';
            isValid = false;
        } else {
            document.getElementById('price-error').textContent = '';
        }

        if (sale_price === '') {
            document.getElementById('sale_price-error').textContent = 'Sale price is required.';
            isValid = false;
        } else if (isNaN(sale_price) || parseFloat(sale_price) <= 0) {
            document.getElementById('sale_price-error').textContent = 'Sale price must be a positive number.';
            isValid = false;
        } else if (parseFloat(sale_price) > parseFloat(price)) {
            document.getElementById('sale_price-error').textContent = 'Sale price must be less than the regular price.';
            isValid = false;
        } else {
            document.getElementById('sale_price-error').textContent = '';
        }

        return isValid;
    }
    let removedImages = [];

    function markForRemoval(imagePath, elementId) {
        if (confirm('Remove this image?')) {
            // Hide the element from UI
            document.getElementById(elementId).remove();

            // Add to removal array
            removedImages.push(imagePath);

            // Update hidden input
            document.getElementById('remove_feature_images').value = JSON.stringify(removedImages);
        }
    }
</script>
