<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Admin: All Tactics
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Filter formulier -->
        <form method="GET" action="{{ route('admin.tactics.index') }}" class="mb-6 flex gap-3 items-center">
            <select name="category"
                    class="rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                Filter
            </button>

            @if(request('category'))
                <a href="{{ route('admin.tactics.index') }}"
                   class="px-3 py-2 text-sm text-gray-600 dark:text-gray-300 hover:underline">
                    Reset
                </a>
            @endif
        </form>

        <!-- Tactics lijst -->
        @if($tactics->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($tactics as $tactic)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                            {{ $tactic->title }}
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                            By: {{ $tactic->user->name }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            Category: {{ $tactic->category->name ?? 'Uncategorized' }}
                        </p>

                        <div class="mt-2 flex items-center gap-2">
                            <form action="{{ route('admin.tactics.approve', $tactic) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="px-2 py-1 rounded-md text-white
                                        {{ $tactic->is_approved ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }}">
                                    {{ $tactic->is_approved ? 'Approved' : 'Not Approved' }}
                                </button>
                            </form>

                            <a href="{{ route('tactics.edit', $tactic) }}"
                               class="px-2 py-1 rounded-md text-yellow-500 hover:text-yellow-600">
                                Edit
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600 dark:text-gray-300">No tactics found.</p>
        @endif
    </div>
</x-app-layout>
