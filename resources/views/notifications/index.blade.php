<x-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-8 space-y-6">

        @php
            $unreadCount = auth()->user()->unreadNotifications()->count();
        @endphp

        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

            <div>
                <h1
                    class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight flex items-center gap-3">
                    <i class="fa-regular fa-bell text-sky-500"></i>
                    Notifications
                </h1>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Stay updated with your teams and game activities.
                </p>
            </div>

            <!-- Notification Actions -->
            @if ($notifications->total() > 0)
                <div class="flex items-center gap-2 flex-wrap">

                    <!-- Mark All as Read -->
                    @if ($unreadCount > 0)
                        <form method="POST" action="{{ route('notifications.markAllRead') }}">
                            @csrf

                            <button type="submit"
                                class="inline-flex items-center gap-2 px-4 py-2.5 bg-sky-50 dark:bg-sky-950/40 hover:bg-sky-100 dark:hover:bg-sky-900/50 text-sky-600 dark:text-sky-400 text-xs font-semibold rounded-xl transition-colors">

                                <i class="fa-solid fa-check-double"></i>
                                Mark All as Read
                            </button>
                        </form>
                    @endif

                    <!-- Delete All -->
                    <form method="POST" action="{{ route('notifications.destroyAll') }}"
                        onsubmit="return confirm('Are you sure you want to delete all notifications?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2.5 bg-rose-50 dark:bg-rose-950/40 hover:bg-rose-100 dark:hover:bg-rose-900/50 text-rose-600 dark:text-rose-400 text-xs font-semibold rounded-xl transition-colors">

                            <i class="fa-solid fa-trash"></i>
                            Delete All
                        </button>
                    </form>

                </div>
            @endif

        </div>

        <!-- Notification Statistics -->
        <div class="grid grid-cols-2 gap-4">

            <!-- Total Notifications -->
            <div
                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700/80 rounded-2xl p-4 shadow-sm">
                <div class="flex items-center gap-3">

                    <div
                        class="w-10 h-10 rounded-xl bg-sky-50 dark:bg-sky-950/50 text-sky-500 flex items-center justify-center">
                        <i class="fa-solid fa-bell"></i>
                    </div>

                    <div>
                        <p class="text-xl font-extrabold text-gray-900 dark:text-white">
                            {{ $notifications->total() }}
                        </p>

                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Total Notifications
                        </p>
                    </div>

                </div>
            </div>

            <!-- Unread Notifications -->
            <div
                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700/80 rounded-2xl p-4 shadow-sm">
                <div class="flex items-center gap-3">

                    <div
                        class="w-10 h-10 rounded-xl bg-rose-50 dark:bg-rose-950/50 text-rose-500 flex items-center justify-center">
                        <i class="fa-solid fa-envelope"></i>
                    </div>

                    <div>
                        <p class="text-xl font-extrabold text-gray-900 dark:text-white">
                            {{ $unreadCount }}
                        </p>

                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Unread
                        </p>
                    </div>

                </div>
            </div>

        </div>

        <!-- Notifications List -->
        <section
            class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700/80 rounded-3xl shadow-sm overflow-hidden">

            <!-- Section Header -->
            <div
                class="px-5 sm:px-6 py-4 border-b border-gray-100 dark:border-gray-700/70 flex items-center justify-between">

                <h2 class="font-bold text-gray-900 dark:text-white">
                    Recent Activity
                </h2>

                <span class="text-xs text-gray-400 dark:text-gray-500">
                    Latest first
                </span>

            </div>

            <!-- Notification Items -->
            <div class="divide-y divide-gray-100 dark:divide-gray-700/60">

                @forelse ($notifications as $notification)
                    @php
                        $data = $notification->data;

                        $isRead = !is_null($notification->read_at);

                        $isGame = ($data['category'] ?? '') === 'game';

                        $iconColor = $isGame
                            ? 'text-sky-500 bg-sky-50 dark:text-sky-400 dark:bg-sky-950/50'
                            : 'text-emerald-500 bg-emerald-50 dark:text-emerald-400 dark:bg-emerald-950/50';
                    @endphp

                    <!-- Notification Row -->
                    <div
                        class="flex items-stretch gap-2 p-3 sm:p-4 transition-colors
                        {{ $isRead ? 'bg-white dark:bg-gray-800' : 'bg-sky-50/50 dark:bg-sky-950/10' }}
                        hover:bg-gray-50 dark:hover:bg-gray-700/30">

                        <!-- Clickable Notification -->
                        <form method="POST" action="{{ route('notifications.read', $notification->id) }}"
                            class="flex-1 min-w-0">

                            @csrf

                            <button type="submit"
                                class="w-full h-full text-left flex items-start gap-4 group focus:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-sky-500 rounded-xl">

                                <!-- Notification Icon -->
                                <div
                                    class="w-11 h-11 shrink-0 rounded-xl flex items-center justify-center {{ $iconColor }}">
                                    <i class="fa-solid {{ $data['icon'] ?? 'fa-bell' }} text-lg"></i>
                                </div>

                                <!-- Notification Content -->
                                <div class="flex-1 min-w-0">

                                    <div class="flex items-center gap-2 flex-wrap">

                                        <h3
                                            class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-sky-600 dark:group-hover:text-sky-400 transition-colors">
                                            {{ $data['title'] ?? 'Notification' }}
                                        </h3>

                                        @unless ($isRead)
                                            <span class="w-2 h-2 bg-sky-500 rounded-full shrink-0"></span>
                                        @endunless

                                    </div>

                                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1 leading-relaxed">
                                        {{ $data['message'] ?? '' }}
                                    </p>

                                    <div class="flex items-center gap-3 mt-3 flex-wrap">

                                        <span
                                            class="text-xs text-gray-400 dark:text-gray-500 flex items-center gap-1.5">
                                            <i class="fa-regular fa-clock"></i>
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>

                                        <span
                                            class="text-[10px] font-bold uppercase tracking-wider
                                            {{ $isGame ? 'text-sky-600 dark:text-sky-400' : 'text-emerald-600 dark:text-emerald-400' }}">
                                            {{ $isGame ? 'Game' : 'Team' }}
                                        </span>

                                    </div>

                                </div>

                                <!-- Open Indicator -->
                                <div
                                    class="shrink-0 w-9 h-9 rounded-xl flex items-center justify-center text-gray-400 group-hover:text-sky-500 group-hover:bg-sky-50 dark:group-hover:bg-sky-950/50 transition-colors">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </div>

                            </button>
                        </form>

                        <!-- Delete Individual Notification -->
                        <form method="POST" action="{{ route('notifications.destroy', $notification->id) }}"
                            onsubmit="return confirm('Are you sure you want to delete this notification?')"
                            class="shrink-0 flex items-center">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-gray-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition-colors"
                                title="Delete notification" aria-label="Delete notification">

                                <i class="fa-solid fa-trash-can"></i>
                            </button>

                        </form>

                    </div>

                @empty

                    <!-- Empty State -->
                    <div class="p-12 text-center space-y-4">

                        <div
                            class="w-16 h-16 mx-auto rounded-2xl bg-gray-100 dark:bg-gray-700/60 text-gray-400 dark:text-gray-300 flex items-center justify-center text-2xl">
                            <i class="fa-regular fa-bell-slash"></i>
                        </div>

                        <div class="space-y-1">

                            <h3 class="font-bold text-gray-900 dark:text-white">
                                You're All Caught Up!
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 max-w-sm mx-auto">
                                You don't have any notifications yet. We'll let you know when something happens.
                            </p>

                        </div>

                        <a href="{{ route('games.index') }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-500 hover:bg-sky-600 text-white text-xs font-semibold rounded-xl transition-colors">

                            <i class="fa-solid fa-compass"></i>
                            Explore Games
                        </a>

                    </div>
                @endforelse

            </div>

            <!-- Pagination -->
            @if ($notifications->hasPages())
                <div class="px-5 py-4 border-t border-gray-100 dark:border-gray-700/70">
                    {{ $notifications->links() }}
                </div>
            @endif

        </section>

    </div>
</x-layout>
