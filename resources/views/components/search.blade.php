<form method="GET" action="{{ route('games.search') }}" class="w-full space-y-3">
    <!-- Seamless Search Wrapper -->
    <div
        class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md p-1.5 rounded-2xl sm:rounded-full border border-gray-200/80 dark:border-gray-700/80 shadow-lg shadow-sky-500/5 flex flex-col sm:flex-row items-stretch sm:items-center gap-1.5 transition-all focus-within:border-sky-500 dark:focus-within:border-sky-500">

        <!-- Keywords Input -->
        <div
            class="flex items-center gap-2.5 px-3 py-2 w-full sm:w-1/2 border-b sm:border-b-0 sm:border-r border-gray-100 dark:border-gray-700/60">
            <i class="fa-solid fa-magnifying-glass text-sky-500 text-xs shrink-0"></i>
            <input type="text" name="keywords" value="{{ request('keywords') }}" placeholder="Search games or sports..."
                class="w-full text-xs sm:text-sm text-gray-800 dark:text-gray-100 placeholder-gray-400 bg-transparent focus:outline-none" />
        </div>

        <!-- Location Input -->
        <div class="flex items-center gap-2.5 px-3 py-2 w-full sm:w-1/2">
            <i class="fa-solid fa-location-dot text-rose-500 text-xs shrink-0"></i>
            <input type="text" name="location" value="{{ request('location') }}" placeholder="Location..."
                class="w-full text-xs sm:text-sm text-gray-800 dark:text-gray-100 placeholder-gray-400 bg-transparent focus:outline-none" />
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full sm:w-auto px-5 py-2.5 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-bold text-xs rounded-xl sm:rounded-full transition-all flex items-center justify-center gap-2 shrink-0 shadow-md shadow-sky-500/20 active:scale-95">
            <i class="fa-solid fa-magnifying-glass text-[11px]"></i>
            <span>Search</span>
        </button>
    </div>

    <!-- Minimal Modern Tags -->
    <div class="flex flex-wrap items-center justify-center gap-1.5 text-xs text-gray-500 dark:text-gray-400">
        <span class="text-[11px] font-semibold text-gray-400 mr-1">Popular:</span>
        <a href="{{ route('games.search', ['keywords' => 'Football']) }}"
            class="px-2.5 py-1 bg-gray-100 dark:bg-gray-800 hover:bg-sky-50 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300 hover:text-sky-600 dark:hover:text-sky-400 rounded-lg text-[11px] font-medium transition-colors border border-gray-200/50 dark:border-gray-700/50">
            ⚽ Football
        </a>
        <a href="{{ route('games.search', ['keywords' => 'Basketball']) }}"
            class="px-2.5 py-1 bg-gray-100 dark:bg-gray-800 hover:bg-sky-50 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300 hover:text-sky-600 dark:hover:text-sky-400 rounded-lg text-[11px] font-medium transition-colors border border-gray-200/50 dark:border-gray-700/50">
            🏀 Basketball
        </a>
        <a href="{{ route('games.search', ['location' => 'Thessaloniki']) }}"
            class="px-2.5 py-1 bg-gray-100 dark:bg-gray-800 hover:bg-sky-50 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300 hover:text-sky-600 dark:hover:text-sky-400 rounded-lg text-[11px] font-medium transition-colors border border-gray-200/50 dark:border-gray-700/50">
            📍 SKG
        </a>
    </div>
</form>
