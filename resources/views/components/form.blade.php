@props([
    'action',
    'fields' => [],
    'buttonText' => 'Save',
    'method' => 'POST'
])

<form method="{{ strtoupper($method) === 'GET' ? 'GET' : 'POST' }}"
      action="{{ $action }}"
      class="space-y-4"
      enctype="multipart/form-data"> {{-- Belangrijk voor file uploads --}}
    @csrf

    @if(!in_array(strtoupper($method), ['GET', 'POST']))
        @method($method)
    @endif

    @foreach ($fields as $name => $field)
        <div>
            <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                {{ ucfirst(str_replace('_', ' ', $name)) }}
            </label>

            @if(($field['type'] ?? '') === 'textarea')
                <textarea
                    id="{{ $name }}"
                    name="{{ $name }}"
                    rows="3"
                    class="w-full border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-100"
                >{{ old($name, $field['value'] ?? '') }}</textarea>

            @elseif(($field['type'] ?? '') === 'select')
                <select
                    id="{{ $name }}"
                    name="{{ $name }}"
                    class="w-full border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-100"
                >
                    <option value="">-- Kies een optie --</option>
                    @foreach($field['options'] as $optionValue => $optionLabel)
                        <option value="{{ $optionValue }}"
                            {{ old($name, $field['value'] ?? '') == $optionValue ? 'selected' : '' }}>
                            {{ $optionLabel }}
                        </option>
                    @endforeach
                </select>

            @elseif(($field['type'] ?? '') === 'file')
                <input
                    type="file"
                    id="{{ $name }}"
                    name="{{ $name }}"
                    class="w-full border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-100"
                >

            @else
                <input
                    type="{{ $field['type'] ?? 'text' }}"
                    id="{{ $name }}"
                    name="{{ $name }}"
                    value="{{ old($name, $field['value'] ?? '') }}"
                    class="w-full border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-100"
                >
            @endif

            @error($name)
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>
    @endforeach

    <div>
        <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
            {{ $buttonText }}
        </button>
    </div>
</form>
