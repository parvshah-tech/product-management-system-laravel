@extends('layouts.header')

@section('content')
    <div class="flex items-center flex-col px-6 lg:px-8">
        <x-header title="Add New Product" />

        <div class="flex-1 flex items-start justify-center overflow-hidden pt-2">
            <div
                class="w-full max-w-5xl bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-xl overflow-hidden">
                <form action="/products" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data"
                    class="flex flex-col h-full">
                    @csrf

                    <!-- Main Two-Column Body -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-2 p-8 overflow-y-auto max-h-[65vh]">

                        <!-- Left Column: Text Info -->
                        <div class="space-y-1">
                            <x-form-input name="name" label="Product Name" placeholder="Enter product name...">
                                <x-slot name="error">
                                    <p class="mt-1 text-[11px] font-medium text-red-600" id="name-error"></p>
                                </x-slot>
                            </x-form-input>

                            <x-form-input name="short_description" label="Short Description"
                                placeholder="Enter short description...">
                                <x-slot name="error">
                                    <p class="mt-1 text-[11px] font-medium text-red-600" id="short_description-error"></p>
                                </x-slot>
                            </x-form-input>

                            <x-form-textarea name="description" label="Product Description" placeholder="Describe..."
                                rows="4">
                                <x-slot name="error">
                                    <p class="mt-1 text-[11px] font-medium text-red-600" id="description-error"></p>
                                </x-slot>
                            </x-form-textarea>

                            <div class="grid grid-cols-2 gap-4">
                                <x-form-input name="price" label="Price" type="number" step="0.01">
                                    <x-slot name="error">
                                        <p class="mt-1 text-[11px] font-medium text-red-600" id="price-error"></p>
                                    </x-slot>
                                </x-form-input>

                                <x-form-input name="sale_price" label="Sale Price" type="number" step="0.01">
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
                                <x-form-select name="category" label="Category">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                    <x-slot name="error">
                                        <p class="mt-1 text-[11px] font-medium text-red-600" id="category-error"></p>
                                    </x-slot>
                                </x-form-select>

                                <x-form-select name="category_id" label="Subcategory">
                                    <option value="">Select Subcategory</option>
                                    <x-slot name="error">
                                        <p class="mt-1 text-[11px] font-medium text-red-600" id="category_id-error"></p>
                                    </x-slot>
                                </x-form-select>
                            </div>

                            <div class="pt-4">
                                <h3 class="text-xs font-black uppercase tracking-widest text-gray-400 mb-4">Media Assets
                                </h3>
                                <x-form-file name="gallery_image" label="Main Image" accept="image/*" />
                                <x-form-file name="feature_images[]" label="Feature Gallery" multiple accept="image/*" />
                            </div>
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
                            Create Product
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
        const category = document.getElementById('category').value.trim();
        const subcategory = document.getElementById('category_id').value.trim();

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

        if (category === '') {
            document.getElementById('category-error').textContent = 'Category is required.';
            isValid = false;
        } else {
            document.getElementById('category-error').textContent = '';
        }

        if (subcategory === '') {
            document.getElementById('category_id-error').textContent = 'Subcategory is required.';
            isValid = false;
        } else {
            document.getElementById('category_id-error').textContent = '';
        }

        return isValid;
    }
    document.addEventListener('DOMContentLoaded', function() {
        const categoryElement = document.getElementById('category');

        if (categoryElement) {
            categoryElement.addEventListener('change', function() {
                let category_id = this.value;

                if (category_id && category_id !== '') {
                    fetch(`/subcategories/${category_id}`)
                        .then(response => response.json())
                        .then(data => {
                            let sub = document.getElementById('category_id');

                            sub.innerHTML = `
                            <option value="">Select Subcategory</option>
                            <x-slot name="error">
                                <p class="mt-1 text-[11px] font-medium text-red-600" id="category_id-error"></p>
                            </x-slot>
                            `;

                            data.forEach(function(item) {

                                sub.innerHTML +=
                                    `<option value="${item.id}">${item.name}</option>`;

                            });
                        })
                        .catch(error => console.error('Error fetching subcategories:', error));
                } else {
                    let sub = document.getElementById('category_id');

                    sub.innerHTML = '<option value="">Select Subcategory</option>';
                }
            });
        }
    });
</script>
