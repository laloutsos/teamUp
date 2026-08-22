@props(['title' => 'Find Your Dream Team (or Enemy)'])

<section
    class="relative bg-cover bg-center bg-no-repeat min-h-[340px] md:h-80 flex items-center justify-center py-10 md:py-0 overflow-hidden">
    <!-- Instagram-style Gradient & Blur Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/70 backdrop-blur-[2px]"></div>

    <div class="container mx-auto text-center z-10 px-4 max-w-3xl">
        <!-- Main Title -->
        <h2 class="text-2xl sm:text-3xl md:text-4xl text-white font-extrabold tracking-tight mb-6 drop-shadow-md">
            {{ $title }}
        </h2>

        <!-- Search Form Container -->
        <form action="{{ route('games.index') }}" method="GET" class="w-full">

            <!-- Desktop Layout: Unified Pill Bar | Mobile Layout: Stacked Glass Cards -->
            <div
                class="flex flex-col md:flex-row items-center bg-white/15 md:bg-white/95 backdrop-blur-md p-2 md:p-1.5 rounded-2xl md:rounded-full border border-white/20 md:border-gray-200/80 shadow-2xl gap-2 md:gap-0 transition-all">

                <!-- Keywords Input -->
                <div class="relative w-full md:flex-1">
                    <i
                        class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" name="keywords" value="{{ request('keywords') }}"
                        placeholder="Search games, teams, tags..."
                        class="w-full pl-10 pr-4 py-3 md:py-2.5 bg-white/90 md:bg-transparent rounded-xl md:rounded-none text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:bg-white md:focus:bg-transparent transition-all border-0" />
                </div>

                <!-- Vertical Divider (Desktop Only) -->
                <div class="hidden md:block w-[1px] h-6 bg-gray-200"></div>

                <!-- Location Input -->
                <div class="relative w-full md:flex-1">
                    <i
                        class="fa-solid fa-location-dot absolute left-4 top-1/2 -translate-y-1/2 text-sky-500 text-sm"></i>
                    <input type="text" name="location" value="{{ request('location') }}"
                        placeholder="Location or City"
                        class="w-full pl-10 pr-4 py-3 md:py-2.5 bg-white/90 md:bg-transparent rounded-xl md:rounded-none text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:bg-white md:focus:bg-transparent transition-all border-0" />
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full md:w-auto px-7 py-3 md:py-2.5 bg-gradient-to-r from-sky-500 to-sky-600 hover:from-sky-600 hover:to-sky-700 active:scale-95 md:active:scale-100 text-white text-sm font-semibold rounded-xl md:rounded-full transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2 flex-shrink-0">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    <span>Search</span>
                </button>
            </div>
        </form>

        <!-- Instagram Explore Quick Tags -->
        <div class="flex items-center justify-center gap-2 mt-4 flex-wrap text-xs text-white/80">
            <span class="font-medium text-white/60">Popular:</span>
            <a href="{{ route('games.index', ['keywords' => 'Football']) }}"
                class="px-2.5 py-1 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/15 transition-colors">⚽
                Football</a>
            <a href="{{ route('games.index', ['keywords' => 'Basketball']) }}"
                class="px-2.5 py-1 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/15 transition-colors">🏀
                Basketball</a>
            <a href="{{ route('games.index', ['location' => 'Thessaloniki']) }}"
                class="px-2.5 py-1 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/15 transition-colors">📍
                Thessaloniki</a>
        </div>

    </div>
</section>
