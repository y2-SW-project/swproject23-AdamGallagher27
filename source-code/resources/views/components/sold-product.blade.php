@livewireStyles
<div>
    <div class="flex justify-center mt-10">
        <div class="grid grid-cols-2 gap-10">

            <div class="w-96">
                <div class="w-full">
                    @if (file_exists(public_path('storage/images/' . $guitar->image)))
                        <img src="{{ asset('storage/images/' . $guitar->image) }}" alt="guitar poster">
                    @else
                        <img src="{{ url('/images/guitar-def-' . rand(1,4) . '.jpg') }}" alt="guitar poster">
                    @endif
                </div>
            </div>
            <div class="w-96">
                <h1 class="text-xl font-medium">{{ $guitar->name }}</h1>
                <ul>
                    <li class="mt-3"><span class="font-medium">Buy Now Price:</span> €{{ $guitar->price }}</li>
                    <li class="mt-3"><span class="font-medium">Current Bid:</span> €{{ $current }}</li>
                    <li class="mt-3"><span class="font-medium">Bid Expiration:</span> {{ $guitar->bid_expiration }}</li>
                    <li class="mt-3"><span class="font-medium">Condition:</span> {{ $condition->condition }}</li>
                    <li class="mt-3"><span class="font-medium">Type:</span> {{ $type->type }}</li>
                    <li class="mt-3"><span class="font-medium">Description:</span> {{ $guitar->description }}</li>

                </ul>
                <ul>
                    {{-- if the user is authenticated load the correct link to account view / button to purchase / bid --}}
                    {{-- if not authenticated the user cannot view users accounts --}}
                    @switch((Auth::check()) ? (Auth::user()->role_id) : ('no role'))
                    {{-- user --}}
                        @case(1)
                            <a href="{{ route('user.account', ['user_id' => $user->id]) }}">
                                <li class="mt-3"><span class="font-medium">Posted By:</span> <span class="underline">{{ $user->name }}</span></li>

                            </a>
                            <li><livewire:like-button :guitar="$guitar" :currentUser="Auth::user()" /> </li>

                        @break

                        {{-- shop --}}
                        @case(2)
                            <a href="{{ route('shop.account', ['user_id' => $user->id]) }}">
                                <li class="mt-3"><span class="font-medium">Posted By:</span> <span class="underline">{{ $user->name }}</span></li>

                            </a>
                            <li><livewire:like-button :guitar="$guitar" :currentUser="Auth::user()" /> </li>
                        @break

                        {{-- admin --}}
                        @case(3)
                            <a href="{{ route('admin.account', ['user_id' => $user->id]) }}">
                                <li class="mt-3"><span class="font-medium">Posted By:</span> <span class="underline">{{ $user->name }}</span></li>
                            </a>
                            <li><livewire:like-button :guitar="$guitar" :currentUser="Auth::user()" /> </li>
                        @break

                        {{-- no role --}}
                        @case('no role')
                            <li class="mt-3"><span class="font-medium">Posted By:</span> <span class="underline">{{ $user->name }}</span></li>
                        @break


                        @default
                            default value
                    @endswitch


                </ul>
            </div>
            <div>

            </div>
        </div>


    </div>

</div>
@livewireScripts
