<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            {{ isset($tactic) ? 'Edit Tactic' : 'Add Tactic' }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto">
        <x-form
            :action="isset($tactic) ? route('tactics.update', $tactic) : route('tactics.store')"
            :fields="$fields"
            :method="isset($tactic) ? 'PUT' : 'POST'"
            :buttonText="isset($tactic) ? 'Update' : 'Save'"
        />
    </div>
</x-app-layout>
