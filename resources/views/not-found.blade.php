@extends('layouts.header')

@section('content')
    <div class="flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <h1 class="text-4xl font-bold mb-4">Page Not Found</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400">The page you are looking for does not exist.</p>
        <div class="mt-6">
            <a href="/"
                class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">Return
                to Home</a>
        </div>
    </div>
@endsection
