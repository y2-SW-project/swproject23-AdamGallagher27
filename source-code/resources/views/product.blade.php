<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product</title>
</head>
<body>
    {{-- product component --}}

    {{-- other producst --}}
    @for ($i = 0; $i < 10; $i++)
        <x-product-card price=20/>
    @endfor
</body>
</html>