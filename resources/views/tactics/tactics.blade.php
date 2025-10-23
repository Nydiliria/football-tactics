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
            @if($tactics->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($tactics as $tactic)
                        <x-crud.card
                            :title="$tactic->title"
                            :description="$tactic->description"
                            :formation="$tactic->formation"
                            :image="$tactic->image_url"
                            :showUrl="route('tactics.show', $tactic->id)"
                            :editUrl="route('tactics.edit', $tactic->id)"
                            :deleteUrl="route('tactics.destroy', $tactic->id)"
                        />
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 dark:text-gray-300">No tactics found yet.</p>
            @endif
        </div>
    </div>
</x-app-layout>
