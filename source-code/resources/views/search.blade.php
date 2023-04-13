

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <x-navbar />
    <x-search-term :phrase='is_null($phrase) ? "" : $phrase' :num='$num' />

    <div class="grid grid-cols-5 mt-4 mx-64">
        @forelse ($guitars as $guitar)
            <div>

                @switch((Auth::check()) ? (Auth::user()->role_id) : ('no role'))
                    {{-- user --}}
                    @case(1)
                        <a href="{{ route('user-guitar.show', $guitar->id) }} class">
                            <x-product-card :guitar='$guitar' />
                        </a>
                    @break

                    {{-- shop --}}
                    @case(2)
                        <a href="{{ route('shop-guitar.show', $guitar->id) }} class">
                            <x-product-card :guitar='$guitar' />
                        </a>
                    @break

                    {{-- admin --}}
                    @case(3)
                        <a href="{{ route('admin-guitar.show', $guitar->id) }} class">
                            <x-product-card :guitar='$guitar' />
                        </a>
                    @break

                    {{-- norole --}}
                    @case('no role')
                        <a href="{{ route('norole-guitar.show', $guitar->id) }} class">
                            <x-product-card :guitar='$guitar' />
                        </a>
                    @break

                    @default
                @endswitch



            </div>
            @empty
                <p>Sorry No Guitars</p>
            @endforelse
        </div>

    
    <div class="w-48 mt-4 mx-auto">
        {{ $guitars->appends(['phrase' => $phrase])->links() }}
    </div>

    <x-footer />
</body>
</html>
