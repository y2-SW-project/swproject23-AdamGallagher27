<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Capo
    </title>

</head>

<body>
    <div>
        <x-navbar />
        <h2>Top Shops</h2>
        @foreach ($users as $user)
            <x-top-shops userName='{{ $user->name }}' img='path' />
        @endforeach
        <h2>Top Products</h2>
        @foreach ($guitars as $guitar)
            <a href="{{ route('norole-guitar.show', $guitar->id) }}">
                <x-product-card price='{{ $guitar->price }}' img='path' />
            </a>
        @endforeach
        <x-home-bottom />
    </div>
</body>

</html>
