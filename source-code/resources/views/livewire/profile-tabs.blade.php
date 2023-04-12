<div class="mx-96 mt-5">
    <button wire:click="$set('show', true)">
        @if ($show)
            <p class="underline font-medium">All</p>
        @else
            All
        @endif
    </button>
    <button wire:click="$set('show', false)">
        @if (!$show)
            <p class="underline font-medium">Likes</p>
        @else
            Likes
        @endif
    </button>
    @if ($show)
        <div class="grid grid-cols-6 mt-4">
            @forelse ($products as $guitar)
                <div>

                    @switch(Auth::user()->role_id)
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

                        @default
                    @endswitch


                </div>
                @empty
                    <p>No Posts</p>
                @endforelse
            </div>
        @else
            <div class="grid grid-cols-6 mt-4">
                @forelse ($likes as $guitar)
                    <div>

                        @switch(Auth::user()->role_id)
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

                            @default
                        @endswitch



                    </div>
                    @empty
                        <p>No Likes Yet</p>
                    @endforelse
                </div>
            @endif
        </div>
