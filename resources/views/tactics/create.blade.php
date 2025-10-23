<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            {{ __('Create New Tactic') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <x-crud.form
                :action="route('tactics.store')"
                :fields="[
                    'title' => ['type' => 'text'],
                    'description' => ['type' => 'textarea'],
                    'formation' => ['type' => 'text'],
                    'image_url' => ['type' => 'url']
                ]"
                buttonText="Create Tactic"
            />
        </div>
    </div>
</x-app-layout>
