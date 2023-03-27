
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>edit guitar</title>
</head>
<body>
    <div class="">
        {{ $guitar }}
        <form action="{{ route('admin-guitar.update', $guitar->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input value={{ $guitar->name }} type="text" name="name" class="w-full " placeholder="name">
            <input value={{ $guitar->description }} type="text" name="description" class="w-full " placeholder="description">
            <input value={{ $guitar->make }} type="text" name="make" class="w-full " placeholder="make">
            <input value={{ $guitar->bid_expiration }} type="text" name="bid_expiration" class="w-full " placeholder="bid expiration time">
            <input value={{ $guitar->price }} type="text" name="price" class="w-full " placeholder="price">
            <input value={{ $guitar->type_id }} type="text" name="type_id" class="w-full " placeholder="type id">
            <input value={{ $guitar->condition_id }} type="text" name="condition_id" class="w-full " placeholder="condition id">
            <input type="hidden" name="user_id" class="w-full " value="{{ auth()->user()->id }}">
            <input type="hidden" name="_token" value="{{ Session::token() }}"> 
            <button name="submit" type="Submit" class="mt-4">submit</button>
        </form>
    </div>
</body>
</html>