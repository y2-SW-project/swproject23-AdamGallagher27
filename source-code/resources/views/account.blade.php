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
        @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

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