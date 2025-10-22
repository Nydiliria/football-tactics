<div class="overflow-x-auto mb-8">
    @if(isset($title))
        <h2 class="text-xl font-semibold mb-3 text-gray-800 dark:text-gray-200">{{ $title }}</h2>
    @endif

    <table class="min-w-full bg-white dark:bg-gray-700 rounded-lg shadow">
        <thead class="bg-gray-100 dark:bg-gray-600">
        <tr>
            @foreach($columns as $col)
                <th class="p-3 text-left border-b text-gray-700 dark:text-gray-200">{{ $col }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        {{ $slot }}
        </tbody>
    </table>
</div>
