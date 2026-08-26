@props(['type', 'message', 'timeout' => '5000'])

@if (session()->has($type))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, {{ $timeout }})" x-show="show" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        class="p-3.5 mb-4 text-xs sm:text-sm font-medium rounded-xl border flex items-center justify-between gap-3 shadow-md transition-all
        {{ $type == 'success'
            ? 'bg-emerald-500/10 text-emerald-700 dark:text-emerald-300 border-emerald-500/20 dark:border-emerald-500/30'
            : 'bg-rose-500/10 text-rose-700 dark:text-rose-300 border-rose-500/20 dark:border-rose-500/30' }}">

        <div class="flex items-center gap-2.5">
            <i
                class="{{ $type == 'success' ? 'fa-solid fa-circle-check text-emerald-500' : 'fa-solid fa-circle-exclamation text-rose-500' }} text-base shrink-0"></i>
            <span>{{ $message }}</span>
        </div>

        <!-- Close Button -->
        <button @click="show = false" class="opacity-60 hover:opacity-100 transition-opacity p-1">
            <i class="fa-solid fa-xmark text-xs"></i>
        </button>
    </div>
@endif
