@php
    $links = [
        ['label' => 'Home', 'route' => '/'],
        ['label' => 'Tactics', 'route' => route('tactics.index')],
        ['label' => 'Add Tactic', 'route' => route('tactics.create')],
    ];
@endphp

<nav class="bg-gray-800 text-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center space-x-8">
                @foreach ($links as $link)
                    @php
                        // Controleer of de huidige pagina deze link is
                        $isActive = request()->is(trim(parse_url($link['route'], PHP_URL_PATH), '/'));
                    @endphp

                    <a href="{{ $link['route'] }}"
                       class="text-lg font-medium {{ $isActive ? 'text-yellow-400 border-b-2 border-yellow-400' : 'hover:text-gray-300' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</nav>
