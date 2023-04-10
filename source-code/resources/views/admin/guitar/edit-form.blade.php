
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>edit guitar</title>
</head>
<body>
    <x-navbar />
    <div class="">
        <form action="{{ route('admin-guitar.update', $guitar->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            @error('name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <input  type="text" name="name" class="w-full " placeholder="name" value="{{ old('name', $guitar->name) }}">
            @error('description')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <input type="text" name="description" class="w-full " placeholder="description" value="{{ old('description', $guitar->description) }}">
            @error('make')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <input type="text" name="make" class="w-full " placeholder="make" value="{{ old('make', $guitar->make) }}">
            @error('bid_expiration')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <input type="datetime-local" name="bid_expiration" class="w-full " placeholder="bid expiration time" value="{{ old('bid_expiration', $guitar->bid_expiration) }}">
            @error('price')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <input type="text" name="price" class="w-full " placeholder="price" value="{{ old('price', $guitar->price) }}">
            @error('type_id')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <input type="text" name="type_id" class="w-full " placeholder="type id" value="{{ old('type_id', $guitar->type_id) }}">
            @error('condition_id')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <input type="text" name="condition_id" class="w-full " placeholder="condition id" value="{{ old('condition_id', $guitar->condition_id) }}">
            @error('image')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <x-file-input type="file" placeholder="Image" name="image" class="w-full mt-6" field="image"></x-file-input>
            <input type="hidden" name="user_id" class="w-full " value="{{ auth()->user()->id }}">
            <input type="hidden" name="_token" value="{{ Session::token() }}"> 
            <button name="submit" type="Submit" class="mt-4">submit</button>
        </form>
    </div>
</body>
</html>