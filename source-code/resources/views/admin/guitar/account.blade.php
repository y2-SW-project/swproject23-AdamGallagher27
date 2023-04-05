<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account</title>
</head>
<body>
    <div>
            {{ $user }}
            {{ $guitar }}
            {{ $liked }}
            {{-- live wire tabs between posts / likes  --}}
            

            {{-- testing nav bar component --}}
            <x-navbar/>

            {{-- table for user data --}}
            {{-- this will take a user object --}}
            {{-- <x-account-data/> --}}

            {{-- products component --}}
            @for ($i = 0; $i < 10; $i++)
                <x-product-card price=20/>
            @endfor
            
    </div>
</body>
</html>