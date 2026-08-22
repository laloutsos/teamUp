<x-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-10">

        @auth
            <!-- Games Grid Section  -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-gray-900 tracking-tight flex items-center gap-2">
                        <i class="fa-solid fa-fire text-rose-500"></i>
                        <span>Upcoming Games</span>
                    </h3>

                    <a href="{{ route('games.index') }}"
                        class="text-xs font-semibold text-sky-600 hover:text-sky-700 flex items-center gap-1">
                        <span>View All</span>
                        <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
                    @forelse($games as $game)
                        <x-game-card :game="$game" />
                    @empty
                        <div
                            class="col-span-full bg-white border border-gray-200 rounded-2xl p-8 text-center space-y-3 shadow-sm">
                            <div
                                class="w-12 h-12 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center mx-auto text-xl">
                                <i class="fa-solid fa-ghost"></i>
                            </div>
                            <p class="text-gray-500 font-medium text-sm">No games available right now.</p>
                            <a href="{{ route('games.create') }}"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white text-xs font-semibold rounded-xl shadow-sm transition-colors">
                                <i class="fa-solid fa-plus"></i>
                                <span>Create First Game</span>
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            @if (isset($games) && $games->isNotEmpty())
                <div class="text-center pt-2">
                    <a href="{{ route('games.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-gray-200 hover:border-gray-300 text-gray-700 hover:text-gray-900 text-sm font-semibold rounded-2xl shadow-sm hover:shadow active:scale-95 transition-all">
                        <span>Show all Games</span>
                        <i class="fa-solid fa-circle-arrow-right text-sky-500 text-base"></i>
                    </a>
                </div>
            @endif

            <!-- Bottom Banner  -->
            <x-bottom-banner />
        @else
            <!-- Dedicated Guest Landing Card -->
            <div class="min-h-[70vh] flex items-center justify-center">
                <div
                    class="w-full max-w-xl bg-white border border-gray-100 shadow-2xl rounded-3xl p-8 sm:p-10 text-center space-y-6 relative overflow-hidden">

                    <!-- Title & Description -->
                    <div class="space-y-3">
                        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                            Find Your Teammates
                        </h1>
                        <p class="text-gray-500 text-sm sm:text-base leading-relaxed max-w-md mx-auto">
                            Join local matches, host sports games, and connect with players around you. Please log in or
                            create an account to get started.
                        </p>
                    </div>

                    <!-- Direct Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
                        <a href="{{ route('login') }}"
                            class="w-full sm:w-1/2 py-3.5 px-6 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-2xl transition-all text-sm flex items-center justify-center gap-2 active:scale-95">
                            <i class="fa-solid fa-right-to-bracket text-gray-500"></i>
                            <span>Log In</span>
                        </a>

                        <a href="{{ route('register') }}"
                            class="w-full sm:w-1/2 py-3.5 px-6 bg-sky-500 hover:bg-sky-600 text-white font-semibold rounded-2xl shadow-lg shadow-sky-500/25 transition-all text-sm flex items-center justify-center gap-2 active:scale-95">
                            <i class="fa-solid fa-user-plus"></i>
                            <span>Create Account</span>
                        </a>
                    </div>

                    <!-- Sports Tags Badges -->
                    <div
                        class="flex flex-wrap justify-center items-center gap-2 pt-4 border-t border-gray-100 text-xs text-gray-400">
                        <span class="px-3 py-1 bg-gray-50 rounded-lg">⚽ Football</span>
                        <span class="px-3 py-1 bg-gray-50 rounded-lg">🏀 Basketball</span>
                        <span class="px-3 py-1 bg-gray-50 rounded-lg">🎾 Tennis</span>
                        <span class="px-3 py-1 bg-gray-50 rounded-lg">🏐 Volleyball</span>
                    </div>

                </div>
            </div>
        @endauth

    </div>
</x-layout>
