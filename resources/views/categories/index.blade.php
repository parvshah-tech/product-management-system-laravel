@extends('layouts.header')

@section('content')
    <x-header title="Categories" subtitle="Manage your store hierarchy" />

    <!-- Quick Add Section -->
    <div class="mb-12 grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Add Main Category -->
        <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl border border-gray-200 dark:border-gray-800 shadow-sm">
            <h3 id='form-title' class="text-sm font-black uppercase tracking-widest text-gray-400 mb-4">Add Main Category</h3>
            <form id='category-form' action="/categories" method="POST" class="flex gap-2"
                onsubmit="return validateCategory()">
                @csrf
                <div id="method-field"></div>
                <div class="flex-1">
                    <x-form-input name="name" label="" placeholder="e.g. Electronics">
                        <x-slot name="error">
                            <p class="mt-1 text-[11px] font-medium text-red-600" id="category-name-error"></p>
                        </x-slot>
                    </x-form-input>
                </div>
                <div class="pt-2">
                    <x-form-button id='submit-btn' class="py-2.5 px-6">Add</x-form-button>
                    <button type="button" id="cancel-edit"
                        class="hidden py-2.5 px-4 text-sm font-bold text-gray-500 hover:text-gray-700 underline">
                        Cancel
                    </button>
                </div>
            </form>
        </div>

        <!-- Add Subcategory -->
        <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl border border-gray-200 dark:border-gray-800 shadow-sm">
            <h3 class="text-sm font-black uppercase tracking-widest text-gray-400 mb-4">Add Subcategory</h3>
            <form action="/categories" method="POST" onsubmit="return validateSubcategory()">
                @csrf
                <div class="flex gap-2">
                    <div class="w-1/3">
                        <x-form-select name="parent_id" label="">
                            <option value="">Select Parent</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                            <x-slot name="error">
                                <p class="mt-1 text-[11px] font-medium text-red-600" id="category-select-error"></p>
                            </x-slot>
                        </x-form-select>
                    </div>
                    <div class="flex-1">
                        <x-form-input name="name" label="" placeholder="e.g. Laptops" class="subcategory-name">
                            <x-slot name="error">
                                <p class="mt-1 text-[11px] font-medium text-red-600" id="subcategory-name-error"></p>
                            </x-slot>
                        </x-form-input>
                    </div>
                    <div class="pt-2">
                        <x-form-button class="py-2.5 px-6">Add</x-form-button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if ($categories->isEmpty())
        <div
            class="text-center py-20 bg-white dark:bg-gray-900 rounded-3xl border-2 border-dashed border-gray-200 dark:border-gray-800">
            <p class="text-gray-500">No categories found. Start by creating one!</p>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Main Categories Column -->
            <section>
                <h3 class="text-xs font-black uppercase tracking-widest text-indigo-600 mb-4 px-2">Main Categories</h3>
                <div
                    class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 overflow-hidden shadow-sm">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-800">
                            <tr>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-right"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @foreach ($categories as $category)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors group"
                                    id="{{ $category->id }}">
                                    <td class="px-6 py-4 text-sm font-mono text-gray-400">#{{ $category->id }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-white">
                                        {{ $category->name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                            {{-- Edit Button --}}
                                            <button type="button" id="{{ $category->id }}-edit"
                                                onclick="event.stopPropagation();"
                                                class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-all"
                                                title="Edit Category">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </button>

                                            {{-- Delete Form --}}
                                            <form action="/categories/{{ $category->id }}" method="POST" class="inline"
                                                onsubmit="return confirm('Delete category: {{ $category->name }}? This will remove all subcategories.')"
                                                onclick="event.stopPropagation();"> @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </section>

            <!-- Subcategories Column -->
            <section>
                <div class="flex items-center justify-between mb-4 px-2">
                    <h3 class="text-xs font-black uppercase tracking-widest text-emerald-600">Subcategories</h3>
                    <span id="active-parent-name" class="text-[10px] font-bold text-gray-400 italic">Select a category to
                        view</span>
                </div>

                <div
                    class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 overflow-hidden shadow-sm min-h-[200px]">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-800">
                            <tr>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Subcategory Name</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase"></th>
                            </tr>
                        </thead>
                        <tbody id="subcategory-table-body" class="divide-y divide-gray-100 dark:divide-gray-800">
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-sm text-gray-400 italic">
                                    Click a main category on the left to load subcategories...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>


        </div>
    @endif
@endsection

<script>
    function validateCategory() {
        const nameInput = document.querySelector('input[name="name"]');
        const errorMsg = document.getElementById('category-name-error');

        if (nameInput.value.trim() === '') {
            errorMsg.innerText = 'Category name is required.';
            return false;
        }

        errorMsg.innerText = '';
        return true;
    }

    function validateSubcategory() {
        let isValid = true;

        const parentInput = document.querySelector('select[name="parent_id"]');
        const nameInput = document.querySelector('.subcategory-name');
        const errorMsg = document.getElementById('subcategory-name-error');
        const parentErrorMsg = document.getElementById('category-select-error');

        if (parentInput.value === '') {
            parentErrorMsg.innerText = 'Please select a parent category.';
            isValid = false;
        } else {
            parentErrorMsg.innerText = '';
        }

        if (nameInput.value.trim() === '') {
            errorMsg.innerText = 'Subcategory name is required.';
            isValid = false;
        } else {
            errorMsg.innerText = '';
        }

        return isValid;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('tr[id]');
        const tableBody = document.getElementById('subcategory-table-body');
        const parentLabel = document.getElementById('active-parent-name');

        rows.forEach(row => {
            row.style.cursor = 'pointer';

            row.addEventListener('click', () => {
                rows.forEach(r => r.classList.remove('bg-indigo-50', 'dark:bg-indigo-900/20'));
                row.classList.add('bg-indigo-50', 'dark:bg-indigo-900/20');

                const categoryId = row.getAttribute('id');
                const categoryName = row.cells[1].innerText;

                parentLabel.innerText = `Loading ${categoryName}...`;
                tableBody.innerHTML =
                    `<tr><td colspan="3" class="px-6 py-10 text-center"><div class="inline-block animate-spin rounded-full h-5 w-5 border-2 border-indigo-500 border-t-transparent"></div></td></tr>`;

                fetch(`/subcategories/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        parentLabel.innerText = `Viewing: ${categoryName}`;

                        if (data.length === 0) {
                            tableBody.innerHTML =
                                `<tr><td colspan="3" class="px-6 py-10 text-center text-gray-400 italic">No subcategories found for this category.</td></tr>`;
                            return;
                        }

                        tableBody.innerHTML = data.map(item => `
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                            <td class="px-6 py-4 text-sm font-mono text-gray-400">#${item.id}</td>
                            <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-white">${item.name}</td>
                            <td class="px-6 py-4">
                                        <div class="flex items-center justify-end gap-2">                                            
                                            <button type="button" id="${item.id}-edit"
                                                onclick="event.stopPropagation();"
                                                class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-all"
                                                title="Edit Category">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </button>
                                            
                                            <form action="/categories/${item.id}" method="POST" class="inline"
                                                onsubmit="return confirm('Delete subcategory: ${item.name}?')"> 
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                        </tr>
                    `).join('');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        tableBody.innerHTML =
                            `<tr><td colspan="3" class="px-6 py-10 text-center text-red-500">Failed to load data.</td></tr>`;
                    });
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('category-form');
        const formTitle = document.getElementById('form-title');
        const nameInput = document.getElementById('name');
        const submitBtn = document.getElementById('submit-btn');
        const methodField = document.getElementById('method-field');
        const cancelBtn = document.getElementById('cancel-edit');

        document.querySelectorAll('[id$="-edit"]').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();

                const id = this.id.replace('-edit', '');
                const name = this.closest('tr').cells[1].innerText.trim();

                form.action = `/categories/${id}`;
                methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';
                nameInput.value = name;
                formTitle.innerText = 'Edit Category';
                submitBtn.innerText = 'Update';
                cancelBtn.classList.remove('hidden');

                nameInput.focus();
            });
        });

        cancelBtn.addEventListener('click', function() {
            form.action = '/categories';
            methodField.innerHTML = '';
            nameInput.value = '';
            formTitle.innerText = 'Add Main Category';
            submitBtn.innerText = 'Save';
            cancelBtn.classList.add('hidden');
        });
    });
</script>
