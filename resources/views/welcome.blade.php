@extends('layouts.header')

@section('content')
    <div class="flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <h1 class="text-4xl font-bold mb-4">Welcome to Shopazon</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400">Manage your products efficiently and effectively.</p>
        <div class="mt-6">
            <a href="/products"
                class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">View
                Products</a>
        </div>
    </div>
@endsection
