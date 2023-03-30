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
    <x-navbar />
    <x-guitar-product :guitar='$guitar' :type='$type' :condition='$condition' :user='$user' />
</body>
</html>