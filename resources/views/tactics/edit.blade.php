<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            {{ __('Edit Tactic') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <x-crud.form
                :action="route('tactics.update', $tactic->id)"
                method="POST"
                :fields="[
                    'title' => ['type' => 'text', 'value' => $tactic->title],
                    'description' => ['type' => 'textarea', 'value' => $tactic->description],
                    'formation' => ['type' => 'text', 'value' => $tactic->formation],
                    'image_url' => ['type' => 'url', 'value' => $tactic->image_url]
                ]"
                buttonText="Save Changes"
            />
        </div>
    </div>
</x-app-layout>
