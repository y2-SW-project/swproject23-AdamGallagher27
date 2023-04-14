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

    <x-navbar />
    <div class="">
        <form class="px-96" action="{{ route('admin-guitar.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @error('name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <input type="text" name="name" class="w-full mt-3" placeholder="name" value="{{ old('name', '') }}">
            @error('description')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <input type="text" name="description" class="w-full mt-3" placeholder="description"
                value="{{ old('description', '') }}">
            @error('make')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <input type="text" name="make" class="w-full mt-3" placeholder="make" value="{{ old('make', '') }}">
            @error('bid_expiration')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <input type="datetime-local" name="bid_expiration" class="w-full mt-3" placeholder="bid expiration time"
                value="{{ old('bid_expiration', '') }}">
            @error('price')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <input type="text" name="price" class="w-full mt-3" placeholder="price" value="{{ old('price', '') }}">

            @error('type_id')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror

            <select class="w-full mt-3" name="type_id" id="type_id">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                @endforeach
            </select>
            
            @error('condition_id')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <select class="w-full mt-3" name="condition_id" id="condition_id">
                @foreach ($conditions as $condition)
                    <option value="{{ $condition->id }}">{{ $condition->condition }}</option>
                @endforeach
            </select>
            @error('image')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <x-file-input type="file" placeholder="Image" name="image" class="w-full mt-6" field="image">
            </x-file-input>
            <input type="hidden" name="user_id" class="w-full " value="{{ auth()->user()->id }}">
            <input type="hidden" name="_token" value="{{ Session::token() }}">
            <button name="submit" type="Submit" class="mt-4 rounded border bg-main text-white px-3">submit</button>
        </form>
    </div>
    <x-footer />

</body>

</html>
