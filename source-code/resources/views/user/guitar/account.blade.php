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

        {{-- table for user data --}}
        {{-- this will take a user object --}}
        <x-account-data :userData='$user' />

        <livewire:profile-tabs :products='$guitar' :likes='$liked' />

    </div>
    @livewireScripts
</body>

</html>
