<form method="GET" action="{{ route('games.search') }}" class="w-full space-y-3">
    <div
        class="bg-white p-1.5 rounded-2xl md:rounded-full shadow-lg flex flex-col md:flex-row items-center gap-1.5 border border-white/20">

        <!-- Keywords Input -->
        <div
            class="flex items-center gap-2 px-3 py-2 w-full md:w-1/2 border-b md:border-b-0 md:border-r border-gray-100">
            <i class="fa-solid fa-magnifying-glass text-gray-400 text-sm"></i>
            <input type="text" name="keywords" value="{{ request('keywords') }}" placeholder="Search games..."
                class="w-full text-xs md:text-sm text-gray-800 placeholder-gray-400 bg-transparent focus:outline-none" />
        </div>

        <!-- Location Input -->
        <div class="flex items-center gap-2 px-3 py-2 w-full md:w-1/2">
            <i class="fa-solid fa-location-dot text-sky-500 text-sm"></i>
            <input type="text" name="location" value="{{ request('location') }}" placeholder="Location..."
                class="w-full text-xs md:text-sm text-gray-800 placeholder-gray-400 bg-transparent focus:outline-none" />
        </div>

        <button type="submit"
            class="w-full md:w-auto px-6 py-2.5 bg-sky-500 hover:bg-sky-600 text-white font-semibold text-xs md:text-sm rounded-xl md:rounded-full transition-colors flex items-center justify-center gap-2 shadow-md shrink-0">
            <i class="fa-solid fa-magnifying-glass text-xs"></i>
            <span>Search</span>
        </button>
    </div>

    <!-- Popular Tags Links (Centered) -->
    <div class="flex flex-wrap items-center justify-center gap-1.5 text-xs text-sky-100">
        <span class="opacity-80 font-medium mr-1 text-[11px]">Popular:</span>
        <a href="{{ route('games.search', ['keywords' => 'Football']) }}"
            class="px-2.5 py-1 bg-white/15 hover:bg-white/25 rounded-full border border-white/10 transition-colors flex items-center gap-1 text-[11px]">
            ⚽ Football
        </a>
        <a href="{{ route('games.search', ['keywords' => 'Basketball']) }}"
            class="px-2.5 py-1 bg-white/15 hover:bg-white/25 rounded-full border border-white/10 transition-colors flex items-center gap-1 text-[11px]">
            🏀 Basketball
        </a>
        <a href="{{ route('games.search', ['location' => 'Thessaloniki']) }}"
            class="px-2.5 py-1 bg-white/15 hover:bg-white/25 rounded-full border border-white/10 transition-colors flex items-center gap-1 text-[11px]">
            📍 Thessaloniki
        </a>
    </div>
</form>
