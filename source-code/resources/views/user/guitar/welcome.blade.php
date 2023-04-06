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
        <h2>Top Products</h2>
        <div class="flex justify-center">
            <div class="flex justify-around px-96 gap-6 mb-32">
                @foreach ($guitars as $guitar)
                <a href="{{ route('user-guitar.show', $guitar->id) }}">
                    <x-product-card :guitar='$guitar' />
                </a>
            @endforeach
            </div>
        </div>
        <x-home-bottom />
    </div>
</body>

</html>
