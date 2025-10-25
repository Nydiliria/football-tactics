@props([
    'title',
    'description' => null,
    'image' => null,
    'formation' => null,
    'category' => null,
    'editUrl' => null,
    'showUrl' => null,
    'deleteUrl' => null,
])

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">

    @if($image)
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-48 object-cover">
    @else
        <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500">
            No image
        </div>
    @endif

    <div class="p-4">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
            {{ $title }}
        </h3>

        @if($description)
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 line-clamp-3">
                {{ $description }}
            </p>
        @endif

        <div class="mt-3 text-xs text-gray-500 dark:text-gray-400 space-y-1">
            @if($formation)
                <p>Formation: <span class="font-medium">{{ $formation }}</span></p>
            @endif

            @if($category)
                <p>Category: <span class="font-medium text-gray-700 dark:text-gray-200">{{ $category }}</span></p>
            @endif
        </div>

        <div class="mt-4 flex justify-between items-center">
            @if($showUrl)
                <a href="{{ $showUrl }}"
                   class="text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                    View
                </a>
            @endif

            <div class="flex space-x-2">
                @if($editUrl)
                    <a href="{{ $editUrl }}"
                       class="text-sm text-yellow-500 hover:text-yellow-600">Edit</a>
                @endif

                @if($deleteUrl)
                    <form action="{{ $deleteUrl }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-red-500 hover:text-red-700">
                            Delete
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
