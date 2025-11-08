<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ $tactic->title }}
            </h2>

            @auth
                @if(auth()->id() === $tactic->user_id || auth()->user()->is_admin)
                    <div class="flex gap-2">
                        <a href="{{ route('tactics.edit', $tactic->id) }}"
                           class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                            Edit
                        </a>

                        <form action="{{ route('tactics.destroy', $tactic->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this tactic?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">
                                Delete
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if($tactic->image_url)
                <img src="{{ Storage::url($tactic->image_url) }}" alt="{{ $tactic->title }}"
                     class="w-full rounded-lg shadow-md">
            @endif

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <p class="text-gray-700 dark:text-gray-200 mb-2"><strong>Category:</strong>
                    {{ $tactic->category->name ?? 'Uncategorized' }}</p>

                <p class="text-gray-700 dark:text-gray-200 mb-2"><strong>Formation:</strong>
                    {{ $tactic->formation ?? 'N/A' }}</p>

                <p class="text-gray-700 dark:text-gray-200 mt-4">{{ $tactic->description }}</p>
            </div>

            <a href="{{ route('tactics.index') }}"
               class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                &larr; Back to Tactics
            </a>
        </div>
    </div>
</x-app-layout>
