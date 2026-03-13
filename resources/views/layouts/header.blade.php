<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
</head>

<body class="bg-gray-50 dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-gray-200 min-h-screen antialiased">
    <!-- Main Header -->
    <header
        class="sticky top-0 z-50 w-full border-b border-gray-200/60 dark:border-gray-800/60 bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                <!-- Logo -->
                <div class="flex items-center gap-2 group">
                    <div
                        class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center shadow-indigo-200 shadow-lg dark:shadow-none">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <a href="/"
                        class="text-xl font-black tracking-tight text-gray-900 dark:text-white transition-colors">
                        Shop<span class="text-indigo-600 dark:text-indigo-400">azon</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center space-x-1 sm:space-x-4">
                    <a href="/products"
                        class="{{ request()->is('products*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400' : 'text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-100 dark:hover:bg-gray-800' }} px-4 py-2 rounded-xl text-sm font-bold transition-all duration-200">
                        Products
                    </a>

                    <a href="/categories"
                        class="{{ request()->is('categories*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400' : 'text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-100 dark:hover:bg-gray-800' }} px-4 py-2 rounded-xl text-sm font-bold transition-all duration-200">
                        Categories
                    </a>

                    {{-- <div class="h-6 w-px bg-gray-200 dark:border-gray-700 mx-2 hidden sm:block"></div>

                    <!-- User Profile / Cart Placeholder -->
                    <button
                        class="p-2 text-gray-500 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </button> --}}
                </div>
            </div>
        </nav>
    </header>

    <!-- Content Wrapper -->
    <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    <!-- Flash Notifications -->
    <x-flash />
</body>


</html>
