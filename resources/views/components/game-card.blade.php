@props(['game'])

<div
    class="max-w-md w-full bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden text-sm flex flex-col justify-between h-full">
    <!-- Top & Middle Content Container -->
    <div class="flex flex-col flex-grow">
        <!-- Header Card -->
        <div class="flex items-center justify-between p-3 border-b border-gray-100">
            <div class="flex items-center gap-3">
                @if ($game->team_logo)
                    <div
                        class="w-10 h-10 rounded-full p-[2px] bg-gradient-to-tr from-amber-500 via-rose-500 to-purple-600 flex-shrink-0">
                        <img src="/storage/{{ $game->team_logo }}" alt="{{ $game->team_name }}"
                            class="w-full h-full object-cover rounded-full bg-white p-0.5" />
                    </div>
                @endif
                <div>
                    <h2 class="font-semibold text-gray-900 leading-tight text-base">
                        {{ $game->title }}
                    </h2>
                    <p class="text-xs text-gray-500 font-normal">{{ $game->game_type }}</p>
                </div>
            </div>

            <!-- Badge Competitive / Not Competitive -->
            <div class="flex-shrink-0">
                @if ($game->competitive)
                    <span
                        class="text-[11px] font-semibold bg-red-50 text-red-600 border border-red-200 rounded-full px-2.5 py-0.5">
                        Competitive
                    </span>
                @else
                    <span
                        class="text-[11px] font-semibold bg-emerald-50 text-emerald-600 border border-emerald-200 rounded-full px-2.5 py-0.5">
                        Not Competitive
                    </span>
                @endif
            </div>
        </div>

        <!-- Body Content -->
        <div class="p-4 space-y-3 flex-grow flex flex-col justify-between">
            <!-- Description -->
            <p class="text-gray-800 leading-relaxed">
                {{-- <span class="font-semibold text-gray-900 mr-1">{{ $game->title }}</span> --}}
                {{ Str::limit($game->description, 100) }}
            </p>

            <!-- Metadata Details -->
            <div class="pt-2 border-t border-gray-100 space-y-1.5 text-xs text-gray-600 mt-auto">
                <div class="flex items-center gap-1.5">
                    <span class="font-semibold text-gray-900">Bet:</span>
                    <span class="font-bold text-gray-900">{{ number_format($game->bet) }}€</span>
                </div>

                <div class="flex items-center gap-1.5">
                    <span class="font-semibold text-gray-900">Location:</span>
                    <span>{{ $game->city }}, {{ $game->exact_location }}</span>
                </div>
                @if ($game->tags)
                    <div class="flex items-start gap-1.5">
                        <span class="font-semibold text-gray-900">Tags:</span>
                        <span class="text-sky-600 font-medium">{{ $game->tags }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Action Button (Pinned to Bottom) -->
    <div class="p-4 pt-0">
        <a href="{{ route('games.show', $game->id) }}"
            class="block w-full text-center px-4 py-2 rounded-lg text-sm font-semibold text-white bg-sky-500 hover:bg-sky-600 active:bg-sky-700 transition-colors shadow-none">
            Details
        </a>
    </div>
</div>
