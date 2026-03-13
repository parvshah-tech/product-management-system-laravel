@props(['name', 'label'])

<div class="mb-4">
    <label class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
        {{ $label }}
    </label>

    <div class="relative group">
        {{-- The actual hidden file input --}}
        <input type="file" name="{{ $name }}" id="{{ $name }}" {{ $attributes }}
            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="updateFileName(this)">

        {{-- The custom UI --}}
        <div
            class="flex items-center justify-between px-4 py-2.5 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-xl group-hover:border-indigo-500 group-hover:bg-indigo-50/30 dark:group-hover:bg-indigo-900/10 transition-all bg-white dark:bg-gray-900">
            <div class="flex items-center gap-3 overflow-hidden">
                {{-- Upload Icon --}}
                <svg class="w-5 h-5 text-gray-400 group-hover:text-indigo-500 shrink-0" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                    </path>
                </svg>
                {{-- Dynamic Filename text --}}
                <span class="text-sm text-gray-500 truncate" id="name-label-{{ $name }}">
                    Click to upload or drag and drop
                </span>
            </div>

            <span
                class="text-[10px] font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/40 px-2 py-1 rounded">
                Browse
            </span>
        </div>
    </div>

    @error($name)
        <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
    @enderror
    {{ $error ?? '' }}
</div>

<script>
    function updateFileName(input) {
        const label = document.getElementById('name-label-' + input.id);
        if (input.files && input.files.length > 0) {
            // Show count if multiple, otherwise show filename
            label.textContent = input.files.length > 1 ?
                input.files.length + ' files selected' :
                input.files[0].name;
            label.classList.remove('text-gray-500');
            label.classList.add('text-indigo-600', 'dark:text-indigo-400', 'font-semibold');
        }
    }
</script>
