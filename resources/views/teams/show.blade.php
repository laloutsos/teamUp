<x-layout>
    <x-slot name="title">{{ $team->name }}</x-slot>

    <div class="max-w-4xl mx-auto px-4 py-8 space-y-5">

        <!-- Flash Notifications -->
        @if (session('error'))
            <div
                class="p-3 bg-red-50 dark:bg-red-950/40 border border-red-200 dark:border-red-900/60 rounded-xl text-red-700 dark:text-red-300 text-xs font-semibold flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation"></i>
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div
                class="p-3 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-900/60 rounded-xl text-emerald-700 dark:text-emerald-300 text-xs font-semibold flex items-center gap-2">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Back Navigation -->
        <a href="{{ route('dashboard.index') }}"
            class="inline-flex items-center gap-2 text-xs font-semibold text-gray-500 dark:text-gray-400 hover:text-sky-500 dark:hover:text-sky-400 transition-colors">
            <i class="fa-solid fa-chevron-left"></i>
            Back to Dashboard
        </a>

        <!-- Team Overview -->
        <div
            class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700/80 rounded-xl shadow-sm overflow-hidden transition-colors">

            <div class="p-5 sm:p-6 space-y-5">

                <!-- Team Heading -->
                <div class="flex items-start justify-between gap-4">

                    <div class="flex items-start gap-3 min-w-0">

                        <div
                            class="w-12 h-12 shrink-0 rounded-xl bg-sky-50 dark:bg-sky-950/50 flex items-center justify-center">
                            <i class="fa-solid fa-people-group text-xl text-sky-500 dark:text-sky-400"></i>
                        </div>

                        <div class="min-w-0">
                            <div class="flex flex-wrap items-center gap-2 mb-1">

                                <span class="text-xs font-semibold text-sky-600 dark:text-sky-400">
                                    {{ ucfirst($team->sport) }}
                                </span>

                                @if (auth()->id() === $team->created_by)
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-wide text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/50 px-2 py-1 rounded-full">
                                        Owner
                                    </span>
                                @endif

                            </div>

                            <h1 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white break-words">
                                {{ $team->name }}
                            </h1>
                        </div>

                    </div>

                    @if (auth()->id() === $team->created_by)
                        <a href="{{ route('teams.edit', $team) }}"
                            class="shrink-0 inline-flex items-center gap-2 px-3 py-2 text-xs font-semibold text-sky-600 dark:text-sky-400 bg-sky-50 dark:bg-sky-950/50 hover:bg-sky-100 dark:hover:bg-sky-900/60 rounded-lg transition-colors">
                            <i class="fa-solid fa-pen-to-square"></i>
                            <span class="hidden sm:inline">Edit Team</span>
                        </a>
                    @endif

                </div>

                <!-- Team Description -->
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                        {{ $team->description ?: 'No description provided.' }}
                    </p>
                </div>

                <!-- Team Quick Information -->
                <div
                    class="flex flex-wrap items-center gap-x-5 gap-y-3 pt-4 border-t border-gray-100 dark:border-gray-700/60">

                    <div class="flex items-center gap-2 text-xs text-gray-600 dark:text-gray-300">
                        <i class="fa-solid fa-location-dot text-sky-500"></i>
                        <span>{{ $team->city ?: 'Location not specified' }}</span>
                    </div>

                    <div class="flex items-center gap-2 text-xs text-gray-600 dark:text-gray-300">
                        <i class="fa-solid fa-users text-sky-500"></i>
                        <span>
                            {{ $team->members->count() }}
                            {{ $team->max_members ? '/ ' . $team->max_members : '' }}
                            Members
                        </span>
                    </div>

                    <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                        <i class="fa-regular fa-calendar text-sky-500"></i>
                        <span>Created {{ $team->created_at->format('d M Y') }}</span>
                    </div>

                </div>

            </div>
        </div>

        <!-- Join Team Section (Non-Members Only) -->
        @auth
            @if (auth()->id() !== $team->created_by && (!$membership || $membership->status === 'pending'))
                <div
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700/80 rounded-xl shadow-sm p-5 transition-colors">

                    @if ($membership && $membership->status === 'pending')
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-amber-50 dark:bg-amber-950/40 flex items-center justify-center">
                                <i class="fa-solid fa-clock text-amber-500 text-lg"></i>
                            </div>

                            <div>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                    Request Pending
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Your request is waiting for the owner's approval.
                                </p>
                            </div>
                        </div>
                    @elseif ($team->max_members !== null && $team->members->count() >= $team->max_members)
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-users-slash text-gray-400 text-xl"></i>
                            <div>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                    Team is Full
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    This team has reached its maximum capacity.
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

                            <div>
                                <h3 class="text-sm font-bold text-gray-900 dark:text-white">
                                    Interested in joining?
                                </h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    Send a request to become a member of this team.
                                </p>
                            </div>

                            <form method="POST" action="{{ route('teams.join', $team) }}">
                                @csrf

                                <button type="submit"
                                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-sky-500 hover:bg-sky-600 text-white text-xs font-semibold rounded-lg transition-colors">
                                    <i class="fa-solid fa-user-plus"></i>
                                    Join Team
                                </button>
                            </form>

                        </div>
                    @endif
                </div>
            @endif
        @endauth

        <!-- Team Members -->
        <div
            class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700/80 rounded-xl shadow-sm overflow-hidden transition-colors">

            <div class="flex items-center justify-between p-5 border-b border-gray-100 dark:border-gray-700/60">

                <h2 class="text-base font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <i class="fa-solid fa-users text-sky-500 dark:text-sky-400"></i>
                    Team Members
                </h2>

                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400">
                    {{ $team->members->count() }} {{ Str::plural('member', $team->members->count()) }}
                </span>

            </div>

            <div class="p-4 space-y-2">

                @forelse ($team->members as $member)
                    <div
                        class="flex items-center justify-between gap-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-900/40 transition-colors">

                        <div class="flex items-center gap-3 min-w-0">

                            <div
                                class="w-10 h-10 shrink-0 rounded-full bg-sky-50 dark:bg-sky-950/50 flex items-center justify-center">
                                <i class="fa-solid fa-user text-sky-500 dark:text-sky-400"></i>
                            </div>

                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                    {{ $member->name }}
                                </p>

                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $member->pivot->role === 'owner' ? 'Team Owner' : 'Member' }}
                                </p>
                            </div>

                        </div>

                        @if ($member->pivot->role === 'owner')
                            <span class="shrink-0 text-xs font-semibold text-amber-600 dark:text-amber-400">
                                <i class="fa-solid fa-crown mr-1"></i>
                                Owner
                            </span>
                        @elseif (auth()->id() === $team->created_by)
                            <form method="POST" action="{{ route('teams.members.remove', [$team, $member]) }}"
                                onsubmit="return confirm('Are you sure you want to remove this member?');">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="shrink-0 inline-flex items-center gap-2 px-3 py-2 bg-red-50 hover:bg-red-100 dark:bg-red-950/40 dark:hover:bg-red-900/60 text-red-600 dark:text-red-400 text-xs font-semibold rounded-lg transition-colors">

                                    <i class="fa-solid fa-user-minus"></i>
                                    <span class="hidden sm:inline">Remove</span>

                                </button>
                            </form>
                        @endif

                    </div>

                @empty

                    <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-5">
                        No members found.
                    </p>
                @endforelse

            </div>
        </div>

        <!-- Pending Requests (Owner Only) -->
        @if (auth()->id() === $team->created_by)

            <div
                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700/80 rounded-xl shadow-sm overflow-hidden transition-colors">

                <div class="flex items-center justify-between p-5 border-b border-gray-100 dark:border-gray-700/60">

                    <h2 class="text-base font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <i class="fa-solid fa-user-clock text-amber-500"></i>
                        Pending Requests
                    </h2>

                    <span class="text-xs font-semibold text-gray-500 dark:text-gray-400">
                        {{ $team->pendingRequests->count() }}
                    </span>

                </div>

                <div class="p-4 space-y-2">

                    @forelse ($team->pendingRequests as $request)
                        <div
                            class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-3 rounded-lg bg-gray-50 dark:bg-gray-900/40 border border-gray-100 dark:border-gray-700/60">

                            <!-- User Information -->
                            <div class="flex items-center gap-3 min-w-0">

                                <div
                                    class="w-9 h-9 shrink-0 rounded-full bg-amber-50 dark:bg-amber-950/40 flex items-center justify-center">
                                    <i class="fa-solid fa-user text-amber-500"></i>
                                </div>

                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                        {{ $request->user->name }}
                                    </p>

                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        Requested {{ $request->created_at->format('d M Y') }}
                                    </p>
                                </div>

                            </div>

                            <!-- Approve / Reject Actions -->
                            <div class="flex items-center gap-2 sm:shrink-0">

                                <!-- Approve -->
                                <form method="POST"
                                    action="{{ route('teams.requests.approve', [$team, $request->user_id]) }}">
                                    @csrf

                                    <button type="submit"
                                        class="inline-flex items-center justify-center gap-2 px-3 py-2 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-semibold rounded-lg transition-colors">
                                        <i class="fa-solid fa-check"></i>
                                        Approve
                                    </button>
                                </form>

                                <!-- Reject -->
                                <form method="POST"
                                    action="{{ route('teams.requests.reject', [$team, $request->user_id]) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="inline-flex items-center justify-center gap-2 px-3 py-2 bg-red-50 hover:bg-red-100 dark:bg-red-950/40 dark:hover:bg-red-900/60 text-red-600 dark:text-red-400 text-xs font-semibold rounded-lg transition-colors">
                                        <i class="fa-solid fa-xmark"></i>
                                        Reject
                                    </button>
                                </form>

                            </div>

                        </div>

                    @empty

                        <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-5">
                            There are no pending membership requests.
                        </p>
                    @endforelse

                </div>
            </div>

        @endif

    </div>
</x-layout>
