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
        <div class="flex gap-4">
            <a class="ml-96 rounded border bg-main text-white px-3"
                href="{{ URL::to('admin/guitar/' . $guitar->id . '/edit') }}">Edit </a>
            <form action=" {{ route('admin-guitar.destroy', $guitar->id) }}" method="POST">
                {{-- delete method for form --}}
                @method('delete')

                {{-- requiered crsf token  --}}
                @csrf

                {{-- button for delete --}}
                <button type="submit" class="rounded border bg-red-500 text-white px-3"
                    onclick="return confirm('are you sure you want to delete')">Delete</button>
            </form>
        </div>
    @endif



    {{-- if the current time is greater than the bid --}}
    {{-- or the component is sold --}}
    {{-- expiration display expired component --}}
    @if (strtotime(date('y-m-d h:i:s')) > strtotime(date($guitar->bid_expiration)) || $guitar->sold)
        <x-sold-product :guitar='$guitar' :type='$type' :condition='$condition' :user='$user' :current='$current' />
    @else
        <x-guitar-product :guitar='$guitar' :type='$type' :condition='$condition' :user='$user' :current='$current' />
    @endif
    <x-footer />
</body>

</html>
