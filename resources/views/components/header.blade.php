@auth
    @php
        $unreadNotificationsCount = auth()->user()->unreadNotifications()->count();
    @endphp
@endauth

<!-- Header (Sticky Top) -->
<header <header data-auth-user-id="{{ auth()->id() }}"
    class="bg-white dark:bg-gray-800/95 border-b border-gray-200/80 dark:border-gray-700/80 sticky top-0 z-50 backdrop-blur-md transition-colors duration-200">

    <div class="w-full px-4 md:px-10 h-16 flex justify-between items-center">

        <!-- Logo (Left) -->
        <h1 class="text-2xl font-bold tracking-tight">
            <a href="{{ url('/') }}"
                class="bg-gradient-to-r from-amber-500 via-rose-500 to-purple-600 bg-clip-text text-transparent hover:opacity-90 transition-opacity">
                TeamUp
            </a>
        </h1>

        <!-- Right Side Container -->
        <div class="flex items-center gap-4">

            <!-- Desktop Navigation (Authenticated Only) -->
            @auth
                <nav class="hidden md:flex items-center space-x-6 text-sm font-semibold">

                    <x-nav-link url="/" :active="request()->is('/')" icon="house">
                        Home
                    </x-nav-link>

                    <x-nav-link url="/games" :active="request()->is('games') && !request()->is('games/create')" icon="compass">
                        All Games
                    </x-nav-link>

                    <x-nav-link url="/bookmarks" :active="request()->is('bookmarks')" icon="bookmark">
                        Saved Games
                    </x-nav-link>

                    <!-- Notifications -->
                    <a href="{{ route('notifications.index') }}"
                        class="relative inline-flex items-center justify-center w-9 h-9 rounded-xl
                        {{ request()->routeIs('notifications.*')
                            ? 'bg-sky-50 dark:bg-sky-950/50 text-sky-600 dark:text-sky-400'
                            : 'text-gray-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60 hover:text-sky-500 dark:hover:text-sky-400' }}
                        transition-all">

                        <i class="fa-regular fa-bell text-lg"></i>

                        <span data-notification-count data-count="{{ $unreadNotificationsCount }}"
                            class="absolute -top-1 -right-1 min-w-[18px] h-[18px] px-1 flex items-center justify-center bg-rose-500 text-white text-[10px] font-bold rounded-full border-2 border-white dark:border-gray-800 {{ $unreadNotificationsCount === 0 ? 'hidden' : '' }}">
                            {{ $unreadNotificationsCount > 99 ? '99+' : $unreadNotificationsCount }}
                        </span>
                    </a>

                    <!-- Dashboard / Profile -->
                    <a href="{{ url('/dashboard') }}"
                        class="inline-flex items-center gap-2 {{ request()->is('dashboard') ? 'text-sky-500 dark:text-sky-400 font-bold' : 'text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white' }} transition-colors">

                        @if (auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar"
                                class="w-7 h-7 rounded-full object-cover border {{ request()->is('dashboard') ? 'border-sky-500 ring-2 ring-sky-200 dark:ring-sky-900/50' : 'border-gray-200 dark:border-gray-600' }}">
                        @else
                            <i class="fa-solid fa-user text-base"></i>
                        @endif

                        <span>Dashboard</span>
                    </a>

                    <div class="h-4 w-px bg-gray-200 dark:bg-gray-700"></div>

                    <!-- Desktop Dark Mode Toggle -->
                    <button onclick="toggleDarkMode()" type="button"
                        class="p-2 text-gray-500 dark:text-gray-400 hover:text-amber-500 dark:hover:text-amber-400 transition-colors cursor-pointer"
                        aria-label="Toggle Theme">

                        <i class="fa-solid fa-sun theme-toggle-sun text-amber-400 text-base"></i>
                        <i class="fa-solid fa-moon theme-toggle-moon text-base"></i>
                    </button>

                    <!-- Desktop Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="inline-flex items-center">
                        @csrf

                        <button type="submit"
                            class="inline-flex items-center gap-1.5 text-gray-500 dark:text-gray-400 hover:text-rose-600 dark:hover:text-rose-400 font-medium transition-colors cursor-pointer whitespace-nowrap">

                            <i class="fa-solid fa-right-from-bracket text-sm"></i>
                            <span>Logout</span>
                        </button>
                    </form>

                    <!-- Create Game -->
                    <a href="{{ url('/games/create') }}"
                        class="inline-flex items-center gap-2 bg-sky-500 hover:bg-sky-600 dark:bg-sky-500 dark:hover:bg-sky-400 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-sm shadow-sky-500/20 transition-all whitespace-nowrap active:scale-95">

                        <i class="fa-solid fa-square-plus"></i>
                        <span>Create Game</span>
                    </a>

                </nav>
            @else
                <!-- Desktop Dark Mode Toggle (Guests) -->
                <button onclick="toggleDarkMode()" type="button"
                    class="hidden md:block p-2 text-gray-500 dark:text-gray-400 hover:text-amber-500 dark:hover:text-amber-400 transition-colors cursor-pointer"
                    aria-label="Toggle Theme">

                    <i class="fa-solid fa-sun theme-toggle-sun text-amber-400 text-base"></i>
                    <i class="fa-solid fa-moon theme-toggle-moon text-base"></i>
                </button>

            @endauth

            <!-- Mobile Header Right -->
            <div class="md:hidden flex items-center gap-2">

                <!-- Mobile Dark Mode Toggle -->
                <button onclick="toggleDarkMode()" type="button"
                    class="p-2 text-gray-500 dark:text-gray-400 hover:text-amber-500 dark:hover:text-amber-400 transition-colors cursor-pointer"
                    aria-label="Toggle Theme">

                    <i class="fa-solid fa-sun theme-toggle-sun text-amber-400 text-base"></i>
                    <i class="fa-solid fa-moon theme-toggle-moon text-base"></i>
                </button>

                @auth

                    <!-- Mobile Notifications -->
                    <a href="{{ route('notifications.index') }}"
                        class="relative flex items-center justify-center w-9 h-9 rounded-xl
                        {{ request()->routeIs('notifications.*')
                            ? 'bg-sky-50 dark:bg-sky-950/50 text-sky-600 dark:text-sky-400'
                            : 'text-gray-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/60' }}
                        transition-colors">

                        <i class="fa-regular fa-bell text-lg"></i>

                        @if ($unreadNotificationsCount > 0)
                            <span
                                class="absolute -top-0.5 -right-0.5 min-w-[16px] h-[16px] px-1 flex items-center justify-center bg-rose-500 text-white text-[9px] font-bold rounded-full border-2 border-white dark:border-gray-800">

                                {{ $unreadNotificationsCount > 99 ? '99+' : $unreadNotificationsCount }}

                            </span>
                        @endif

                    </a>

                    <!-- Mobile Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                            class="flex items-center gap-1.5 text-xs font-semibold text-rose-500 hover:text-rose-600 dark:text-rose-400 dark:hover:text-rose-300 bg-rose-50 dark:bg-rose-950/40 px-3 py-1.5 rounded-full border border-rose-100 dark:border-rose-900/60 active:scale-95 transition-all">

                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                        </button>
                    </form>

                @endauth

            </div>

        </div>
    </div>
</header>


<!-- Mobile Bottom Navigation (Authenticated Only) -->
@auth
    <nav
        class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-white/95 dark:bg-gray-800/95 backdrop-blur-md border-t border-gray-200/80 dark:border-gray-700/80 px-4 py-2 shadow-lg flex justify-between items-center">

        <!-- Home -->
        <x-nav-link url="/" :active="request()->is('/')" icon="house" :mobile="true">
            Home
        </x-nav-link>

        <!-- All Games -->
        <x-nav-link url="/games" :active="request()->is('games') && !request()->is('bookmarks')" icon="compass" :mobile="true">
            Games
        </x-nav-link>

        <!-- Create Game -->
        <a href="{{ url('/games/create') }}"
            class="flex items-center justify-center w-10 h-10 bg-gradient-to-tr from-sky-400 to-sky-600 text-white rounded-full shadow-md active:scale-95 transition-transform -mt-2">

            <i class="fa-solid fa-plus text-lg"></i>
        </a>

        <!-- Saved Games -->
        <x-nav-link url="/bookmarks" :active="request()->is('bookmarks')" icon="bookmark" :mobile="true">
            Saved
        </x-nav-link>

        <!-- Mobile Dashboard / Profile -->
        <a href="{{ url('/dashboard') }}"
            class="flex flex-col items-center gap-0.5 text-[10px] font-medium transition-all {{ request()->is('dashboard') ? 'text-sky-500 dark:text-sky-400 font-bold' : 'text-gray-500 dark:text-gray-400' }}">

            @if (auth()->user()->avatar)
                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar"
                    class="w-6 h-6 rounded-full object-cover border {{ request()->is('dashboard') ? 'border-sky-500 ring-2 ring-sky-200 dark:ring-sky-900/50' : 'border-gray-300 dark:border-gray-600' }}">
            @else
                <i class="fa-solid fa-user text-base"></i>
            @endif

            <span>Profile</span>
        </a>

    </nav>
@endauth
