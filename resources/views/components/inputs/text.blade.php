@props(['id', 'name', 'label' => null, 'type' => 'text', 'value' => '', 'placeholder' => '', 'icon' => null])

<div>
    @if ($label)
        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1" for="{{ $id }}">
            {{ $label }}
        </label>
    @endif

    <div class="relative flex items-center">
        @if ($icon)
            <i
                class="{{ $icon }} absolute left-3.5 text-gray-400 dark:text-gray-500 text-sm pointer-events-none z-10"></i>
        @endif

        <input id="{{ $id }}" type="{{ $type }}" name="{{ $name }}"
            value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}"
            {{ $attributes->merge([
                'class' =>
                    'w-full py-2.5 text-sm bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white border rounded-xl focus:bg-white dark:focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-all placeholder:text-gray-400 dark:placeholder:text-gray-500 ' .
                    ($icon ? 'pl-10 pr-4' : 'px-3.5') .
                    ' ' .
                    ($errors->has($name) ? 'border-red-500' : 'border-gray-200 dark:border-gray-600'),
            ]) }} />
    </div>

    @error($name)
        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
    @enderror
</div>
