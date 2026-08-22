@if ($paginator->hasPages())
    <div class="flex flex-col items-center justify-center gap-3 pt-6 pb-20 md:pb-6">

        <!-- Navigation Buttons (Centered & Responsive) -->
        <nav role="navigation" aria-label="Pagination Navigation"
            class="flex flex-wrap items-center justify-center gap-1.5 px-2">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span
                    class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-gray-400 bg-gray-50 border border-gray-100 rounded-xl cursor-not-allowed opacity-60 select-none">
                    <i class="fa-solid fa-chevron-left text-[9px]"></i>
                    <span>Prev</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-gray-700 hover:text-sky-600 bg-white hover:bg-sky-50/50 border border-gray-200 hover:border-sky-200 rounded-xl shadow-sm active:scale-95 transition-all">
                    <i class="fa-solid fa-chevron-left text-[9px]"></i>
                    <span>Prev</span>
                </a>
            @endif

            {{-- Numeric Page Links --}}
            <div class="flex items-center gap-1">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="px-1.5 py-1 text-xs text-gray-400 font-bold select-none">{{ $element }}</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span
                                    class="w-7 h-7 md:w-8 md:h-8 flex items-center justify-center text-xs font-bold text-white bg-sky-500 rounded-xl shadow-sm shadow-sky-200">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="w-7 h-7 md:w-8 md:h-8 flex items-center justify-center text-xs font-semibold text-gray-600 hover:text-sky-600 hover:bg-sky-50 border border-transparent hover:border-sky-200 rounded-xl transition-all">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                    class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-gray-700 hover:text-sky-600 bg-white hover:bg-sky-50/50 border border-gray-200 hover:border-sky-200 rounded-xl shadow-sm active:scale-95 transition-all">
                    <span>Next</span>
                    <i class="fa-solid fa-chevron-right text-[9px]"></i>
                </a>
            @else
                <span
                    class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-gray-400 bg-gray-50 border border-gray-100 rounded-xl cursor-not-allowed opacity-60 select-none">
                    <span>Next</span>
                    <i class="fa-solid fa-chevron-right text-[9px]"></i>
                </span>
            @endif

        </nav>

        <!-- Centered Info Text -->
        <p class="text-[11px] text-gray-400 font-medium">
            Showing <span class="font-bold text-gray-600">{{ $paginator->firstItem() }}</span>
            to <span class="font-bold text-gray-600">{{ $paginator->lastItem() }}</span>
            of <span class="font-bold text-gray-600">{{ $paginator->total() }}</span> results
        </p>

    </div>
@endif
