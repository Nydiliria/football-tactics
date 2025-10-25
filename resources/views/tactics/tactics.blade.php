<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Tactics Overview') }}
            </h2>

            <a href="{{ route('tactics.create') }}"
               class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                + Add Tactic
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="GET" action="{{ route('tactics.index') }}" class="mb-6 flex gap-3 items-center">
                <select name="category"
                        class="rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Alle categorieën</option>
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    Filter
                </button>

                @if(request('category'))
                    <a href="{{ route('tactics.index') }}"
                       class="px-3 py-2 text-sm text-gray-600 dark:text-gray-300 hover:underline">
                        Reset
                    </a>
                @endif
            </form>

            @if($tactics->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($tactics as $tactic)
                        <x-card
                            :title="$tactic->title"
                            :description="$tactic->description"
                            :image="$tactic->image_url ? Storage::url($tactic->image_url) : null"
                            :formation="$tactic->formation"
                            :category="$tactic->category->name ?? 'Uncategorized'"
                            :show-url="route('tactics.show', $tactic->id)"
                            :edit-url="route('tactics.edit', $tactic->id)"
                            :delete-url="route('tactics.destroy', $tactic->id)"
                        />
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 dark:text-gray-300">No tactics found yet.</p>
            @endif
        </div>
    </div>
</x-app-layout>
