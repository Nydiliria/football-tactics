<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Tactics Overview') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            <x-data-table :title="'Tactics'" :columns="['ID', 'Title', 'Description', 'Formation', 'Image']">
                @foreach($tactics as $tactic)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="p-3 border-b text-gray-800 dark:text-gray-100">{{ $tactic->id }}</td>
                        <td class="p-3 border-b">{{ $tactic->title }}</td>
                        <td class="p-3 border-b">{{ $tactic->description }}</td>
                        <td class="p-3 border-b">{{ $tactic->formation }}</td>
                        <td class="p-3 border-b">
                            <img src="{{ $tactic->image_url }}" alt="tactic image" class="w-20 rounded">
                        </td>
                    </tr>
                @endforeach
            </x-data-table>
        </div>
    </div>
</x-app-layout>
