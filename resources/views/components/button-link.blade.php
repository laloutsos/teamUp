@props([
    'url' => '/',
    'icon' => null,
    'bgClass' => 'bg-white dark:bg-gray-800',
    'hoverClass' => 'hover:bg-gray-100 dark:hover:bg-gray-700',
    'textClass' => 'text-sky-600 dark:text-sky-400',
    'block' => false,
])

<a href="{{ $url }}"
    {{ $attributes->merge([
        'class' =>
            "{$bgClass} {$hoverClass} {$textClass} px-4 py-2.5 rounded-xl border border-gray-200/80 dark:border-gray-700/60 font-semibold text-xs sm:text-sm shadow-2xs hover:shadow-md active:scale-[0.98] transition-all duration-200 inline-flex items-center justify-center gap-2 " .
            ($block ? 'w-full flex' : 'inline-flex'),
    ]) }}>
    @if ($icon)
        <i class="fa-solid fa-{{ $icon }} text-xs shrink-0"></i>
    @endif

    <span>{{ $slot }}</span>
</a>
