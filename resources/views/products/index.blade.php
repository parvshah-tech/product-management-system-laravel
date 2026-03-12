@extends('layouts.header')

@section('content')
    <x-header title="Products" subtitle="Total Products: {{ $total }}">
        <a href="/products/create" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-sm">
            + New Product
        </a>
    </x-header>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:justify-items-center">
        @forelse ($products as $product)
            <x-product-card :product="$product" />
        @empty
            <p class="text-gray-500 dark:text-gray-400 text-sm italic">No products available!</p>
        @endforelse
    </div>

    <div class="mt-10 border-t border-gray-200 dark:border-gray-800 pt-6">
        {{ $products->links() }}
    </div>
@endsection
