@props(['id', 'name', 'label' => null, 'value' => '', 'options' => []])

<div>
    @if ($label)
        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1" for="{{ $id }}">
            {{ $label }}
        </label>
    @endif

    <select id="{{ $id }}" name="{{ $name }}"
        class="w-full px-3.5 py-2 text-sm bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-lg focus:bg-white dark:focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-all text-gray-800 dark:text-gray-100">
        @foreach ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" {{ old($name, $value) == $optionValue ? 'selected' : '' }}
                class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100">
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
</div>
