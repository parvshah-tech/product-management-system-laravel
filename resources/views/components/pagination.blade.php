@props(['total', 'limit' => 12, 'totalPages' => 1, 'currentPage' => 1])

<div class="flex flex-col items-center gap-6 mt-10 mb-6">
    <!-- Meta Info -->
    <div
        class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 dark:text-gray-500 flex items-center gap-2">
        <span class="w-8 h-px bg-gray-200 dark:bg-gray-800"></span>
        Displaying <span class="text-indigo-600">{{ $total }}</span> Items
        <span class="w-8 h-px bg-gray-200 dark:bg-gray-800"></span>
    </div>

    <!-- Main Navigation Bar -->
    <div
        class="inline-flex items-center p-1.5 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm transition-all">

        <!-- Previous Button -->
        <button data-page="{{ $currentPage - 1 }}" {{ $currentPage <= 1 ? 'disabled' : '' }}
            class="p-2.5 rounded-xl text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 disabled:opacity-30 disabled:cursor-not-allowed transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <!-- Page Numbers -->
        <div class="flex items-center px-2">
            @for ($page = 1; $page <= $totalPages; $page++)
                @if ($page == 1 || $page == $totalPages || ($page >= $currentPage - 1 && $page <= $currentPage + 1))
                    @if ($page == $currentPage)
                        <button id="{{ $page }}"
                            class="relative z-10 px-4 py-2 text-sm font-black text-white bg-indigo-600 rounded-xl shadow-lg shadow-indigo-200 dark:shadow-none transition-all scale-110"
                            data-page="{{ $page }}">
                            {{ $page }}
                        </button>
                    @else
                        <button id="{{ $page }}"
                            class="px-4 py-2 text-sm font-bold text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-800 rounded-xl transition-all"
                            data-page="{{ $page }}">
                            {{ $page }}
                        </button>
                    @endif
                @elseif ($page == 2 || $page == $totalPages - 1)
                    <span class="px-2 text-gray-300 dark:text-gray-600 font-bold select-none">···</span>
                @endif
            @endfor
        </div>

        <!-- Next Button -->
        <button data-page="{{ $currentPage + 1 }}" {{ $currentPage >= $totalPages ? 'disabled' : '' }}
            class="p-2.5 rounded-xl text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 disabled:opacity-30 disabled:cursor-not-allowed transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>
</div>


<script>
    const currentPage = {{ $currentPage }};

    document.querySelectorAll('button[id]').forEach(button => {
        button.addEventListener('click', () => {
            const page = button.getAttribute('data-page');
            // console.log('Page clicked:', page);
            $.ajax({
                url: `/products/paginate/${page}`,
                method: 'GET',
                success: function(response) {
                    // Handle the response and update the product list
                    console.log(response);
                },
                error: function(error) {
                    console.error('Error loading more products:', error);
                }
            });
        });
    });
</script>
