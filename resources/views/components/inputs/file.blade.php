@props(['id', 'name', 'label' => null])

<div class="mb-4">
    @if ($label)
        <label for="{{ $id }}" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
        </label>
    @endif

    <input type="file" id="{{ $id }}" name="{{ $name }}"
        {{ $attributes->merge([
            'class' => 'block w-full text-xs text-gray-500 dark:text-gray-400
                                                                file:mr-4 file:py-2 file:px-4 
                                                                file:rounded-xl file:border-0 
                                                                file:text-xs file:font-semibold 
                                                                file:bg-sky-50 file:text-sky-700 
                                                                hover:file:bg-sky-100 
                                                                dark:file:bg-sky-950/60 dark:file:text-sky-400 
                                                                dark:hover:file:bg-sky-900/50 
                                                                cursor-pointer border border-gray-200 dark:border-gray-700/60 
                                                                bg-gray-50 dark:bg-gray-700/50 rounded-2xl transition-all',
        ]) }} />

    @error($name)
        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
