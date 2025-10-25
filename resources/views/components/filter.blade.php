@props([
    'action' => '#',
    'categories' => [],
    'selected' => null,
])

<form method="GET" action="{{ $action }}" class="mb-6 flex gap-3 items-center">
    <select name="category"
            class="rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
        <option value="">Alle categorieën</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $selected == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
        Filter
    </button>
</form>
