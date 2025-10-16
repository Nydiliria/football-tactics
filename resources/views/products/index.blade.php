<h1>{{ $message }}</h1>

<ul>
    @foreach ($teams as $team)
        <li>{{ $team }}</li>
    @endforeach
</ul>
