<x-layout>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
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
