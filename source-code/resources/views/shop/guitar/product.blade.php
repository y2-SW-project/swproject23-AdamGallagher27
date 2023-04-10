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

    {{-- show success message for update / create --}}
    @if (session('success'))
    <div class="mb-4 px-4 py-2 bg-green-100 border border-green-200 text-green">
        {{ session('success') }}
    </div>
@endif

    @if (Auth::user()->id === $guitar->user_id)
    <a href="{{ URL::to('shop/guitar/' . $guitar->id . '/edit') }}">edit </a>
    @endif


    {{-- if the current time is greater than the bid --}}
    {{-- expiration display expired component --}}
    @if (date('y-m-d h:i:s') > $guitar->bid_expiration)
        {{-- {{ date('y-m-d h:i:s') }} --}}
        <x-guitar-product :guitar='$guitar' :type='$type' :condition='$condition' :user='$user' :current='$current'  />  
        @else
        <x-sold-product :guitar='$guitar' :type='$type' :condition='$condition' :user='$user' :current='$current' />
    @endif
</body>
</html>