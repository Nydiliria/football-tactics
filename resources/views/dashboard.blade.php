<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            {{-- Flash messages --}}
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Notice: </strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                     role="alert">
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif

            {{-- Dashboard info --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            {{-- Login count section --}}
            @auth
                @php
                    $loginCount = \App\Models\Login::where('user_id', auth()->id())->count();
                @endphp

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p>You have logged in
                            <strong>{{ $loginCount }}</strong>
                            {{ \Illuminate\Support\Str::plural('time', $loginCount) }}.
                        </p>

                        @if ($loginCount < 3)
                            <p class="text-red-500 mt-2">
                                You need {{ 3 - $loginCount }} more login(s) before you can create tactics.
                            </p>
                        @else
                            <p class="text-green-500 mt-2">
                                You can now create and share your tactics!
                            </p>
                        @endif
                    </div>
                </div>
            @endauth

        </div>
    </div>
</x-app-layout>
