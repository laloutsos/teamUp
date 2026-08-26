@props(['game'])

<div
    class="w-full bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700/60 shadow-sm hover:shadow transition-all flex flex-col justify-between rounded-2xl sm:rounded-xl p-0 sm:p-3.5 overflow-hidden">

    <!-- Header (Instagram Style on Mobile) -->
    <div
        class="flex items-center justify-between p-3 sm:p-0 sm:pb-2 border-b sm:border-b-0 border-gray-50 dark:border-gray-700/40">
        <div class="flex items-center gap-2.5 min-w-0">
            @if ($game->team_logo)
                <!-- Gradient Ring like Instagram Stories on Mobile -->
                <div
                    class="p-[1.5px] bg-gradient-to-tr from-amber-500 via-rose-500 to-purple-600 rounded-full shrink-0 sm:bg-none sm:p-0">
                    <img src="/storage/{{ $game->team_logo }}" alt="{{ $game->team_name }}"
                        class="w-8 h-8 rounded-full object-cover bg-white dark:bg-gray-800 p-0.5 sm:p-0" />
                </div>
            @else
                <div
                    class="w-8 h-8 rounded-full sm:rounded-lg bg-sky-50 dark:bg-sky-950 text-sky-500 flex items-center justify-center shrink-0 font-bold text-xs ring-2 ring-rose-500/30 sm:ring-0">
                    ⚽
                </div>
            @endif
            <div class="min-w-0">
                <h3 class="font-bold text-gray-900 dark:text-white text-xs sm:text-sm truncate">
                    {{ $game->title }}
                </h3>
                <p class="text-[10px] text-gray-400 font-medium uppercase tracking-wider">{{ $game->game_type }}</p>
            </div>
        </div>

        <!-- Compact Badge -->
        <span
            class="text-[10px] font-bold px-2 py-0.5 rounded-full sm:rounded-md shrink-0 {{ $game->competitive ? 'bg-rose-50 text-rose-600 dark:bg-rose-950/50 dark:text-rose-400' : 'bg-emerald-50 text-emerald-600 dark:bg-emerald-950/50 dark:text-emerald-400' }}">
            {{ $game->competitive ? 'Competitive' : 'Casual' }}
        </span>
    </div>

    <!-- Description (Main Content Body) -->
    <div class="p-3 sm:p-0 sm:py-2 space-y-2">
        <p class="text-xs text-gray-700 dark:text-gray-300 line-clamp-2 leading-relaxed">
            <span class="font-bold text-gray-900 dark:text-white sm:hidden">{{ $game->team_name ?? 'Match' }}</span>
            {{ $game->description }}
        </p>

        <!-- Location & Price Info Bar (Instagram Post Meta Style) -->
        <div class="flex items-center justify-between text-[11px] text-gray-500 pt-1">
            <div class="flex items-center gap-1 truncate max-w-[65%] text-gray-600 dark:text-gray-400 font-medium">
                <i class="fa-solid fa-location-dot text-rose-500 sm:text-sky-500 text-[11px]"></i>
                <span class="truncate">{{ $game->city }}</span>
            </div>

            <div class="font-extrabold text-gray-900 dark:text-white text-xs sm:text-sm">
                {{ number_format($game->bet) }}€
            </div>
        </div>
    </div>

    <!-- Action Link (Full Width Button on Mobile) -->
    <div class="p-3 pt-0 sm:p-0">
        <a href="{{ route('games.show', $game->id) }}"
            class="w-full py-2 sm:py-1.5 text-center text-xs font-bold text-sky-600 dark:text-sky-400 bg-sky-50 dark:bg-sky-950/40 hover:bg-sky-100 dark:hover:bg-sky-900/50 rounded-xl sm:rounded-lg transition-colors block">
            View Match
        </a>
    </div>
</div>
