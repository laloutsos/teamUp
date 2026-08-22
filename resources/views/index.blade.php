<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Available Game Listings</title>
</head>

<body>
    <h1> {{ $title }}</h1>
    <ul>
        @forelse($games as $game)
            <li>
                {{ $game }}
            </li>
        @empty
        @endforelse
    </ul>


</body>

</html>
