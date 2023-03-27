<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Capo
        </title>

    </head>
    <body>
        <div>
            {{-- @if (Route::has('login'))
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
            @endif--}}

            {{-- testing nav bar component --}}
            <x-navbar/>

            {{-- {{ $guitars }} --}}
            

            {{-- testing category buttons component --}}
            {{-- @for ($i = 0; $i < 10; $i++)
            <x-category-buttons title='test' />
            @endfor --}}

            {{-- testing top shops component --}}
            {{-- @for ($i = 0; $i < 10; $i++)
            <x-top-shops userName='test' img='path' />
            @endfor --}}
            @foreach ($guitars as $guitar)
                <a href="{{route('shop-guitar.show', $guitar->id) }}">show </a>
                <br>
                <a href="{{route('shop-guitar.edit', $guitar->id) }}">edit </a>
                <x-top-shops userName='{{ $guitar->name }}' img='path' />
            @endforeach

            {{-- shop now / create shop component --}}
            <x-home-bottom />
            
        </div>
    </body>
</html>
