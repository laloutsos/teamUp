@props(['id', 'name', 'label' => null, 'value' => '', 'placeholder' => '', 'rows' => '7', 'cols' => '30'])

<div>
    <div>
        @if ($label)
            <label class="block text-xs font-semibold text-gray-700 mb-1" for="{{ $id }}">
                {{ $label }}
            </label>
        @endif

        <textarea cols="{{ $cols }}" rows="{{ $rows }}" id="{{ $id }}" name="{{ $name }}"
            class="w-full px-3.5 py-2 text-sm bg-gray-50 border rounded-lg focus:bg-white focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-all placeholder:text-gray-400 @error($name) border-red-500 focus:border-red-500 focus:ring-red-500/20 @else border-gray-200 @enderror"
            placeholder="{{ $placeholder }}">{{ old($name, $value) }}</textarea>

        @error($name)
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
