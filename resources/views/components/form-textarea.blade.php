@props(['name', 'label', 'rows' => 5])

<div class="mb-5">
    <label for="{{ $name }}" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
        {{ $label }}
    </label>
    <textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}"
        {{ $attributes->merge(['class' => 'w-full px-4 py-2.5 rounded-lg border bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all shadow-sm ' . ($errors->has($name) ? 'border-red-500' : 'border-gray-300 dark:border-gray-700')]) }}>{{ old($name, $slot) }}</textarea>

    @error($name)
        <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
    @enderror
    {{ $error ?? '' }}
</div>
