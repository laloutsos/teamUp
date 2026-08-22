@props(['url' => '/', 'active' => false, 'icon' => null, 'mobile' => false])

@if ($mobile)
    <a href="{{ $url }}"
        class="flex flex-col items-center gap-0.5 text-xs font-medium transition-colors {{ $active ? 'text-sky-500 font-semibold' : 'text-gray-500 hover:text-gray-900' }}">
        @if ($icon)
            <i class="fa-solid fa-{{ $icon }} text-lg"></i>
        @endif
        <span>{{ $slot }}</span>
    </a>
@else
    <a href="{{ $url }}"
        class="flex items-center gap-2 py-2 transition-colors relative {{ $active ? 'text-gray-900 font-bold' : 'text-gray-600 hover:text-gray-900 font-medium' }}">
        @if ($icon)
            <i class="fa-solid fa-{{ $icon }} text-lg"></i>
        @endif
        <span>{{ $slot }}</span>
    </a>
@endif
