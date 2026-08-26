<x-layout>

    <!-- Back Button -->
    @if (request()->has('keywords') || request()->has('location'))
        <div class="mb-4">
            <a href="{{ route('games.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:text-sky-600 dark:hover:text-sky-400 rounded-2xl text-xs font-bold shadow-sm border border-gray-100 dark:border-gray-700/80 transition-all duration-200 hover:shadow-md hover:-translate-x-1 group">
                <i
                    class="fa-solid fa-arrow-left text-sky-500 dark:text-sky-400 transition-transform group-hover:-translate-x-0.5"></i>
                <span>Back to All Games</span>
            </a>
        </div>
    @endif

    <!-- Search & Header Section (Exact Hero Style) -->
    <section class="w-full max-w-2xl mx-auto px-4 py-6 sm:py-8 text-center space-y-5 mb-4">
        <!-- Main Title with Gradient Text -->
        <h1 class="text-2xl sm:text-4xl font-black tracking-tight text-gray-900 dark:text-white leading-tight">
            Find Your <span class="bg-gradient-to-r from-sky-400 to-blue-600 bg-clip-text text-transparent">Dream
                Team</span>
        </h1>

        <!-- Search Bar Component -->
        <div class="w-full">
            <x-search />
        </div>
    </section>

    <!-- Games Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-6">
        @forelse($games as $game)
            <x-game-card :game="$game" />
        @empty
            <div
                class="col-span-full bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700/80 rounded-3xl p-10 text-center space-y-2 shadow-sm transition-colors">
                <i class="fa-solid fa-folder-open text-sky-500 dark:text-sky-400 text-3xl mb-2"></i>
                <p class="text-gray-700 dark:text-gray-200 font-bold">No games available</p>
                <p class="text-gray-400 dark:text-gray-400 text-xs">Check back later for new matches.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination Links --}}
    <div class="mt-8">
        {{ $games->links('vendor.pagination.tailwind') }}
    </div>

</x-layout>
