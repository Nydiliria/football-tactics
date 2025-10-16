<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tactics</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 2rem auto;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 0.75rem;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
<h1 style="text-align:center;">All Tactics</h1>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Formation</th>
        <th>Image</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tactics as $tactic)
        <tr>
            <td>{{ $tactic->id }}</td>
            <td>{{ $tactic->title }}</td>
            <td>{{ $tactic->description }}</td>
            <td>{{ $tactic->formation }}</td>
            <td><img src="{{ $tactic->image_url }}" alt="tactic image" width="80"></td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
