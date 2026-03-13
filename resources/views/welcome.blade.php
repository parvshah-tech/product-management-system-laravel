@extends('layouts.header')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-[60vh] text-center px-6">
        <!-- Minimal Badge -->
        <span class="text-xs font-black uppercase tracking-widest text-indigo-600 dark:text-indigo-400 mb-4">
            Inventory Management
        </span>

        <!-- Bold Title -->
        <h1 class="text-5xl md:text-6xl font-black text-gray-900 dark:text-white tracking-tight mb-6">
            Welcome to <span class="text-indigo-600">Shopazon</span>
        </h1>

        <!-- Simple Subtext -->
        <p class="max-w-xl text-lg text-gray-600 dark:text-gray-400 leading-relaxed mb-10">
            A streamlined workspace to manage your products and categories.
            Simple, fast, and efficient.
        </p>

        <!-- Clean Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 items-center">
            <a href="/products"
                class="w-full sm:w-auto px-10 py-4 bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-bold rounded-2xl hover:scale-105 transition-transform shadow-xl">
                View Products
            </a>

            <a href="/categories"
                class="w-full sm:w-auto px-10 py-4 bg-white dark:bg-gray-900 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 font-bold rounded-2xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                Categories
            </a>
        </div>
    </div>
@endsection
