<!-- Header (Sticky Top) -->
<header class="bg-white border-b border-gray-200 sticky top-0 z-50">
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
                    class="inline-flex items-center gap-2 {{ request()->is('dashboard') ? 'text-sky-500 font-bold' : 'text-gray-600 hover:text-gray-900' }} transition-colors">
                    @if (auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar"
                            class="w-7 h-7 rounded-full object-cover border {{ request()->is('dashboard') ? 'border-sky-500 ring-2 ring-sky-200' : 'border-gray-200' }}">
                    @else
                        <i class="fa-solid fa-user text-base"></i>
                    @endif
                    <span>Dashboard</span>
                </a>

                <div class="h-4 w-px bg-gray-200"></div>

                <!-- Desktop Logout Link -->
                <form method="POST" action="{{ route('logout') }}" class="inline-flex items-center">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center gap-1.5 text-gray-500 hover:text-rose-600 font-medium transition-colors cursor-pointer whitespace-nowrap">
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
            @endauth
        </nav>

        <!-- Mobile Header Right (Logout Button for Mobile) -->
        @auth
            <div class="md:hidden flex items-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-1.5 text-xs font-semibold text-rose-500 hover:text-rose-600 bg-rose-50 px-3 py-1.5 rounded-full border border-rose-100 active:scale-95 transition-all">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        @endauth
    </div>
</header>

<!-- Mobile Layout Logic -->
@auth
    <!-- Mobile Instagram-Style Bottom Navigation Bar -->
    <nav
        class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-t border-gray-200 px-4 py-2 shadow-lg flex justify-between items-center">

        <!-- Home -->
        <x-nav-link url="/" :active="request()->is('/')" icon="house" :mobile="true">Home</x-nav-link>

        <!-- All Games -->
        <x-nav-link url="/games" :active="request()->is('games') && !request()->is('games/saved')" icon="compass" :mobile="true">Games</x-nav-link>

        <!-- Create Game (Center Action Button) -->
        <a href="{{ url('/games/create') }}"
            class="flex items-center justify-center w-10 h-10 bg-gradient-to-tr from-sky-400 to-sky-600 text-white rounded-full shadow-md active:scale-95 transition-transform -mt-2">
            <i class="fa-solid fa-plus text-lg"></i>
        </a>

        <!-- Saved Games -->
        <x-nav-link url="/games/saved" :active="request()->is('games/saved')" icon="bookmark" :mobile="true">Saved</x-nav-link>

        <!-- Mobile Dashboard / Profile with Avatar -->
        <a href="{{ url('/dashboard') }}"
            class="flex flex-col items-center gap-0.5 text-[10px] font-medium transition-all {{ request()->is('dashboard') ? 'text-sky-500 font-bold' : 'text-gray-500' }}">
            @if (auth()->user()->avatar)
                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar"
                    class="w-6 h-6 rounded-full object-cover border {{ request()->is('dashboard') ? 'border-sky-500 ring-2 ring-sky-200' : 'border-gray-300' }}">
            @else
                <i class="fa-solid fa-user text-base"></i>
            @endif
            <span>Profile</span>
        </a>

    </nav>
@else
    <!-- Floating Mobile Instagram-Style Guest Bar -->
    <div class="md:hidden fixed bottom-4 left-4 right-4 z-50">
        <div
            class="bg-white/90 backdrop-blur-md border border-gray-200 shadow-2xl rounded-2xl p-3 flex items-center justify-between gap-3">
            <div class="flex items-center gap-2 pl-2">
                <div
                    class="w-8 h-8 rounded-full bg-gradient-to-tr from-amber-500 via-rose-500 to-purple-600 flex items-center justify-center text-white text-xs shadow-sm">
                    <i class="fa-solid fa-users"></i>
                </div>
                <span class="text-xs font-bold text-gray-800">Join TeamUp</span>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ url('/login') }}"
                    class="px-4 py-2 text-xs font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
                    Log In
                </a>
                <a href="{{ url('/register') }}"
                    class="px-4 py-2 text-xs font-semibold text-white bg-sky-500 hover:bg-sky-600 rounded-xl shadow-sm transition-colors">
                    Register
                </a>
            </div>
        </div>
    </div>
@endauth
