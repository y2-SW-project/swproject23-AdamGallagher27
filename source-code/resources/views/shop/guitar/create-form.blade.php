{{-- create me please --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create guitar</title>
</head>
<body>
    <div class="">
        <form action="{{ route('shop-guitar.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" name="name" class="w-full " placeholder="name">
            <input type="text" name="description" class="w-full " placeholder="description">
            <input type="text" name="make" class="w-full " placeholder="make">
            <input type="datetime-local" name="bid_expiration" class="w-full " placeholder="bid expiration time">
            <input type="text" name="price" class="w-full " placeholder="price">
            <input type="text" name="type_id" class="w-full " placeholder="type id">
            <input type="text" name="condition_id" class="w-full " placeholder="condition id">
            <input type="hidden" name="user_id" class="w-full " value="{{ auth()->user()->id }}">
            <input type="hidden" name="_token" value="{{ Session::token() }}"> 
            <button name="submit" type="Submit" class="mt-4">submit</button>
        </form>
    </div>
</body>
</html>