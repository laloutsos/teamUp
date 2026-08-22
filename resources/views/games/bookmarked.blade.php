<x-layout>
    <!-- Header Section -->
    <div class="mb-6 flex flex-col items-center justify-center text-center space-y-1">
        <h2 class="text-2xl font-bold tracking-tight text-gray-800">
            Bookmarked Games
        </h2>
        <p class="text-xs text-gray-400 font-medium">
            Your saved matches and favorite games in one place.
        </p>
    </div>

    <!-- Games Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @forelse($bookmarks as $game)
            <x-game-card :game="$game" />
        @empty
            <div class="col-span-full bg-white border border-gray-100 rounded-3xl p-10 text-center space-y-2 shadow-sm">
                <i class="fa-solid fa-bookmark text-sky-500 text-3xl mb-2"></i>
                <p class="text-gray-700 font-bold">No saved games yet</p>
                <p class="text-gray-400 text-xs">Bookmark games to easily find them later.</p>
            </div>
        @endforelse
    </div>

    {{-- Centered Pagination Links --}}
    @if ($bookmarks->hasPages())
        <div class="mt-8">
            {{ $bookmarks->links('vendor.pagination.tailwind') }}
        </div>
    @endif
</x-layout>
