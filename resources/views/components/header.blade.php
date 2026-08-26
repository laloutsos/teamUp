<!-- Header (Sticky Top) -->
<header
    class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50 transition-colors duration-200">
    <div class="w-full px-4 md:px-10 h-16 flex justify-between items-center">
        <!-- Logo (Left) -->
        <h1 class="text-2xl font-bold tracking-tight">
            <a href="{{ url('/') }}"
                class="bg-gradient-to-r from-amber-500 via-rose-500 to-purple-600 bg-clip-text text-transparent hover:opacity-90 transition-opacity">
                TeamUp
            </a>
        </h1>

        <!-- Desktop Navigation (Right) -->
        <nav class="hidden md:flex items-center space-x-6 text-sm font-semibold">
            @auth
                <x-nav-link url="/" :active="request()->is('/')" icon="house">Home</x-nav-link>

                <x-nav-link url="/games" :active="request()->is('games*')" icon="compass">All Games</x-nav-link>

                <x-nav-link url="/bookmarks" :active="request()->is('bookmarks')" icon="bookmark">Saved Games</x-nav-link>

                <!-- Dashboard / Profile with Avatar -->
                <a href="{{ url('/dashboard') }}"
                    class="inline-flex items-center gap-2 {{ request()->is('dashboard') ? 'text-sky-500 font-bold' : 'text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white' }} transition-colors">
                    @if (auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar"
                            class="w-7 h-7 rounded-full object-cover border {{ request()->is('dashboard') ? 'border-sky-500 ring-2 ring-sky-200' : 'border-gray-200 dark:border-gray-600' }}">
                    @else
                        <i class="fa-solid fa-user text-base"></i>
                    @endif
                    <span>Dashboard</span>
                </a>

                <div class="h-4 w-px bg-gray-200 dark:bg-gray-700"></div>

                <!-- Desktop Dark Mode Toggle Button (Authenticated) -->
                <button onclick="toggleDarkMode()" type="button"
                    class="p-2 text-gray-500 dark:text-gray-400 hover:text-amber-500 dark:hover:text-amber-400 transition-colors cursor-pointer">
                    <i class="fa-solid fa-sun theme-toggle-sun text-amber-400 text-base"></i>
                    <i class="fa-solid fa-moon theme-toggle-moon text-base"></i>
                </button>

                <!-- Desktop Logout Link -->
                <form method="POST" action="{{ route('logout') }}" class="inline-flex items-center">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center gap-1.5 text-gray-500 dark:text-gray-400 hover:text-rose-600 dark:hover:text-rose-400 font-medium transition-colors cursor-pointer whitespace-nowrap">
                        <i class="fa-solid fa-right-from-bracket text-sm"></i>
                        <span>Logout</span>
                    </button>
                </form>

                <!-- Primary Action Button -->
                <a href="{{ url('/games/create') }}"
                    class="inline-flex items-center gap-2 bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-sm transition-all whitespace-nowrap">
                    <i class="fa-solid fa-square-plus"></i>
                    <span>Create Game</span>
                </a>
            @else
                <!-- Dark Mode Toggle Button for Guests -->
                <button onclick="toggleDarkMode()" type="button"
                    class="p-2 text-gray-500 dark:text-gray-400 hover:text-amber-500 dark:hover:text-amber-400 transition-colors cursor-pointer">
                    <i class="fa-solid fa-sun theme-toggle-sun text-amber-400 text-base"></i>
                    <i class="fa-solid fa-moon theme-toggle-moon text-base"></i>
                </button>
            @endauth
        </nav>

        <!-- Mobile Header Right -->
        <div class="md:hidden flex items-center gap-2">
            <!-- Mobile Dark Mode Toggle Button -->
            <button onclick="toggleDarkMode()" type="button"
                class="p-2 text-gray-500 dark:text-gray-400 hover:text-amber-500 dark:hover:text-amber-400 transition-colors cursor-pointer">
                <i class="fa-solid fa-sun theme-toggle-sun text-amber-400 text-base"></i>
                <i class="fa-solid fa-moon theme-toggle-moon text-base"></i>
            </button>

            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-1.5 text-xs font-semibold text-rose-500 hover:text-rose-600 bg-rose-50 dark:bg-rose-950/30 px-3 py-1.5 rounded-full border border-rose-100 dark:border-rose-900 active:scale-95 transition-all">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </button>
                </form>
            @endauth
        </div>
    </div>
</header>
