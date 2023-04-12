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
        <h2 class="ml-80 pl-6 font-medium text-xl">Our Favourite <span class="text-main">Products</span></h2>
        <div class="grid grid-cols-6 px-80 mb-20 mt-6">
      
            @foreach ($guitars as $guitar)
            <div>
                <a href="{{ route('admin-guitar.show', $guitar->id) }} class">
                    <x-product-card :guitar='$guitar' />
                </a>
            </div>
            @endforeach

        </div>
        <x-home-bottom />
    </div>
</body>

</html>
