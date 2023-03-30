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

    {{-- delete button to remove movie --}}
    <form action=" {{ route('admin-guitar.destroy', $guitar->id) }}" method="POST">
        {{-- delete method for form --}}
        @method('delete')

        {{-- requiered crsf token  --}}
        @csrf

        {{-- button for delete --}}
        <button type="submit"
            onclick="return confirm('are you sure you want to delete')">Delete</button>
    </form>

    
</body>
</html>