<x-layout>

    <!-- Back Button -->
    @if (request()->has('keywords') || request()->has('location'))
        <div class="mb-4">
            <a href="{{ route('games.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-white text-gray-700 hover:text-sky-600 rounded-2xl text-xs font-bold shadow-sm border border-gray-100 transition-all duration-200 hover:shadow-md hover:-translate-x-1 group">
                <i class="fa-solid fa-arrow-left text-sky-500 transition-transform group-hover:-translate-x-0.5"></i>
                <span>Back to All Games</span>
            </a>
        </div>
    @endif

    <!-- Search & Header Section -->
    <div
        class="bg-gradient-to-r from-sky-500 to-blue-600 rounded-3xl p-6 md:p-8 mb-6 shadow-sm flex flex-col lg:flex-row lg:items-center justify-between gap-6 text-white">

        <!-- Header Text -->
        <div class="space-y-1 text-center md:text-left">
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">Search Games</h1>
            <p class="text-xs md:text-sm text-sky-100">Find available matches and tournaments</p>
        </div>

        <!-- Search Box Container -->
        <div class="w-full lg:max-w-2xl md:max-w-xl">
            <x-search />
        </div>

    </div>

    <!-- Games Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-6">
        @forelse($games as $game)
            <x-game-card :game="$game" />
        @empty
            <div class="col-span-full bg-white border border-gray-100 rounded-3xl p-10 text-center space-y-2 shadow-sm">
                <i class="fa-solid fa-folder-open text-sky-500 text-3xl mb-2"></i>
                <p class="text-gray-700 font-bold">No games available</p>
                <p class="text-gray-400 text-xs">Check back later for new matches.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination Links --}}
    <div class="mt-8">
        {{ $games->links('vendor.pagination.tailwind') }}
    </div>

</x-layout>
