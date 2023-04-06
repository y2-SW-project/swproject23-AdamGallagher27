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

    {{-- if the current time is greater than the bid --}}
    {{-- expiration display expired component --}}
    @if (date('y-m-d h:i:s') < $guitar->bid_expiration)
        {{-- {{ date('y-m-d h:i:s') }} --}}
        <x-sold-product :guitar='$guitar' :type='$type' :condition='$condition' :user='$user' :current='$current' />
    @else
        <x-guitar-product :guitar='$guitar' :type='$type' :condition='$condition' :user='$user' :current='$current'  />  
    @endif
</body>
</html>