<x-layout>

    <!-- Back Button -->
    @if (request()->has('keywords') || request()->has('city') || request()->has('sport'))
        <div class="mb-4 px-4 max-w-7xl mx-auto">
            <a href="{{ route('teams.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:text-sky-600 dark:hover:text-sky-400 rounded-2xl text-xs font-bold shadow-sm border border-gray-100 dark:border-gray-700/80 transition-all duration-200 hover:shadow-md hover:-translate-x-1 group">
                <i
                    class="fa-solid fa-arrow-left text-sky-500 dark:text-sky-400 transition-transform group-hover:-translate-x-0.5"></i>
                <span>Back to All Teams</span>
            </a>
        </div>
    @endif

    <!-- Search & Header Section -->
    <section class="w-full max-w-2xl mx-auto px-4 py-6 sm:py-8 text-center space-y-5 mb-4">

        <h1 class="text-2xl sm:text-4xl font-black tracking-tight text-gray-900 dark:text-white leading-tight">
            Find Your
            <span class="bg-gradient-to-r from-sky-400 to-blue-600 bg-clip-text text-transparent">
                Dream Team
            </span>
        </h1>

        <p class="text-sm text-gray-500 dark:text-gray-400">
            Discover sports teams, connect with players and become part of something bigger.
        </p>

        <!-- Team Search -->
        <form action="{{ route('teams.index') }}" method="GET"
            class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700/80 rounded-2xl shadow-sm p-3 space-y-3">

            <input type="text" name="keywords" value="{{ request('keywords') }}"
                placeholder="Search teams by name..."
                class="w-full px-4 py-3 text-sm text-gray-800 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-500 bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition-colors">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                <select name="sport"
                    class="w-full px-4 py-3 text-sm text-gray-700 dark:text-gray-200 bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-sky-500 outline-none">
                    <option value="">All Sports</option>
                    <option value="football" @selected(request('sport') === 'football')>Football</option>
                    <option value="basketball" @selected(request('sport') === 'basketball')>Basketball</option>
                    <option value="volleyball" @selected(request('sport') === 'volleyball')>Volleyball</option>
                </select>

                <input type="text" name="city" value="{{ request('city') }}" placeholder="City..."
                    class="w-full px-4 py-3 text-sm text-gray-800 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-500 bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition-colors">

            </div>

            <div class="flex flex-col sm:flex-row gap-2">

                <button type="submit"
                    class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-3 bg-sky-500 hover:bg-sky-600 text-white text-xs font-bold rounded-xl shadow-sm transition-all active:scale-95 cursor-pointer">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>Search Teams</span>
                </button>

                <a href="{{ route('teams.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-xs font-bold rounded-xl transition-colors">
                    <i class="fa-solid fa-rotate-left"></i>
                    <span>Reset</span>
                </a>

            </div>
        </form>

        <!-- Create Team Button -->
        @auth
            <div class="pt-1">
                <a href="{{ route('teams.create') }}"
                    class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-bold rounded-2xl shadow-md shadow-emerald-500/20 transition-all active:scale-95">
                    <i class="fa-solid fa-plus"></i>
                    <span>Create Your Team</span>
                </a>
            </div>
        @endauth

    </section>

    <!-- Teams Grid -->
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-6">

        @forelse($teams as $team)
            <div
                class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700/80 rounded-3xl p-5 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200 flex flex-col justify-between gap-4">

                <div class="space-y-3">

                    <div class="flex items-center justify-between">

                        <span
                            class="px-3 py-1 bg-sky-50 dark:bg-sky-950/50 text-sky-600 dark:text-sky-400 border border-sky-100 dark:border-sky-900/60 rounded-full text-xs font-bold uppercase tracking-wider">
                            {{ $team->sport }}
                        </span>

                        <i class="fa-solid fa-people-group text-xl text-sky-500 dark:text-sky-400"></i>

                    </div>

                    <h3 class="text-lg font-extrabold text-gray-900 dark:text-white">
                        {{ $team->name }}
                    </h3>

                    <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed line-clamp-3">
                        {{ $team->description ?: 'No description available.' }}
                    </p>

                    <div class="flex flex-wrap items-center gap-4 text-xs text-gray-500 dark:text-gray-400">

                        <span class="flex items-center gap-1">
                            <i class="fa-solid fa-location-dot text-rose-500"></i>
                            {{ $team->city ?: 'Location not specified' }}
                        </span>

                        <span class="flex items-center gap-1">
                            <i class="fa-solid fa-users text-sky-500 dark:text-sky-400"></i>
                            {{ $team->members_count }} members
                        </span>

                    </div>

                </div>

                <div class="pt-3 border-t border-gray-100 dark:border-gray-700/60 flex items-center justify-between">

                    <span class="text-xs text-gray-400 dark:text-gray-500">
                        Created {{ $team->created_at->format('d M Y') }}
                    </span>

                    <a href="{{ route('teams.show', $team) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-sky-50 dark:bg-sky-950/50 text-sky-600 dark:text-sky-400 hover:bg-sky-100 dark:hover:bg-sky-900/60 text-xs font-bold rounded-xl transition-colors">
                        <span>View Team</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                </div>

            </div>

        @empty

            <div
                class="col-span-full bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700/80 rounded-3xl p-10 text-center space-y-2 shadow-sm transition-colors">

                <i class="fa-solid fa-people-group text-sky-500 dark:text-sky-400 text-3xl mb-2"></i>

                <p class="text-gray-700 dark:text-gray-200 font-bold">
                    No teams available
                </p>

                <p class="text-gray-400 dark:text-gray-400 text-xs">
                    No teams match your search. Try different filters or create a new team.
                </p>

                @auth
                    <a href="{{ route('teams.create') }}"
                        class="inline-flex items-center gap-2 mt-3 px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-bold rounded-xl transition-colors">
                        <i class="fa-solid fa-plus"></i>
                        <span>Create First Team</span>
                    </a>
                @endauth

            </div>
        @endforelse

    </div>

    <!-- Pagination -->
    <div class="max-w-7xl mx-auto px-4 mt-8">
        {{ $teams->links('vendor.pagination.tailwind') }}
    </div>

</x-layout>
