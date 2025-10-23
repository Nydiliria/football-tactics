@props([
    'action',
    'fields' => [],
    'buttonText' => 'Save',
    'method' => 'POST'
])

<form method="POST" action="{{ $action }}" class="space-y-4">
    @csrf

    @foreach ($fields as $name => $field)
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                {{ ucfirst($name) }}
            </label>

            @if($field['type'] === 'textarea')
                <textarea name="{{ $name }}" rows="3"
                          class="w-full border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-100">{{ old($name, $field['value'] ?? '') }}</textarea>
            @else
                <input type="{{ $field['type'] ?? 'text' }}"
                       name="{{ $name }}"
                       value="{{ old($name, $field['value'] ?? '') }}"
                       class="w-full border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-100">
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
