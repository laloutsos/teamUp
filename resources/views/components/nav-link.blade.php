@props(['url' => '/', 'active' => false, 'icon' => null, 'mobile' => false])

@if ($mobile)
    <a href="{{ $url }}"
        class="flex flex-col items-center gap-0.5 text-[10px] sm:text-xs font-medium transition-colors {{ $active ? 'text-sky-500 dark:text-sky-400 font-bold' : 'text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100' }}">
        @if ($icon)
            <i class="fa-solid fa-{{ $icon }} text-base sm:text-lg"></i>
        @endif
        <span>{{ $slot }}</span>
    </a>
@else
    <a href="{{ $url }}"
        class="flex items-center gap-2 py-2 transition-colors relative {{ $active ? 'text-sky-500 dark:text-sky-400 font-bold' : 'text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white font-medium' }}">
        @if ($icon)
            <i class="fa-solid fa-{{ $icon }} text-base"></i>
        @endif
        <span>{{ $slot }}</span>

        @if ($active)
            <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-sky-500 dark:bg-sky-400 rounded-full"></span>
        @endif
    </a>
@endif
