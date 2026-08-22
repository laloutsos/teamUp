@props(['id', 'name', 'label' => null, 'value' => '', 'options' => []])

<div>
    @if ($label)
        <label class="block text-xs font-semibold text-gray-700 mb-1" for="{{ $id }}">
            {{ $label }}
        </label>
    @endif

    <select id="{{ $id }}" name="{{ $name }}"
        class="w-full px-3.5 py-2 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-all text-gray-800">
        @foreach ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" {{ old($name, $value) == $optionValue ? 'selected' : '' }}>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
</div>
