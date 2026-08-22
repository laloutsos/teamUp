@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}"
        class="flex items-center justify-between gap-3 pt-4">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span
                class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-gray-400 bg-gray-50 border border-gray-100 rounded-2xl cursor-not-allowed opacity-60 select-none">
                <i class="fa-solid fa-chevron-left text-[10px]"></i>
                <span>Previous</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-gray-700 hover:text-sky-600 bg-white hover:bg-sky-50/50 border border-gray-200 hover:border-sky-200 rounded-2xl shadow-sm active:scale-95 transition-all">
                <i class="fa-solid fa-chevron-left text-[10px]"></i>
                <span>Previous</span>
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-gray-700 hover:text-sky-600 bg-white hover:bg-sky-50/50 border border-gray-200 hover:border-sky-200 rounded-2xl shadow-sm active:scale-95 transition-all">
                <span>Next</span>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
            </a>
        @else
            <span
                class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-gray-400 bg-gray-50 border border-gray-100 rounded-2xl cursor-not-allowed opacity-60 select-none">
                <span>Next</span>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
            </span>
        @endif

    </nav>
@endif
