<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account</title>
    @livewireStyles
</head>

<body>
    <div>
        <x-navbar />
        {{-- show success message for update / create --}}
        @if (session('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 border border-green-200 text-green">
                {{ session('success') }}
            </div>
        @endif

        <x-account-data :userData='$user' />
        <a class="ml-96 rounded border bg-main text-white px-3" href="{{ URL::to('shop/guitar/create') }}">create </a>
        {{-- table for user data --}}
        {{-- this will take a user object --}}
        {{-- <x-account-data/> --}}

        <livewire:profile-tabs :products='$guitar' :likes='$liked' />

    </div>
    @livewireScripts
    <x-footer />
</body>

</html>
