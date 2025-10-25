<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Categories</h2>
            <a href="{{ route('categories.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                + Add Category
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto">
        @if(session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif

        @if($categories->count())
            <table class="min-w-full border border-gray-300 rounded-md overflow-hidden">
                <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="p-2 text-white text-left">Name</th>
                    <th class="p-2 text-white text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr class="border-t dark:border-gray-700">
                        <td class="p-2 text-white">{{ $category->name }}</td>
                        <td class="p-2 text-white text-right space-x-2">
                            <a href="{{ route('categories.edit', $category) }}" class="text-yellow-600 hover:underline">Edit</a>

                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this category?')"
                                        class="text-red-600 hover:underline">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600 dark:text-gray-300">No categories found.</p>
        @endif
    </div>
</x-app-layout>
