@livewireStyles
<div>
    <div class="flex justify-center mt-10">
        <div class="grid grid-cols-2 gap-10">

            <div class="w-96">
                <div class="w-full">
                    @if (file_exists(public_path('storage/images/' . $guitar->image)))
                        <img src="{{ asset('storage/images/' . $guitar->image) }}" alt="guitar poster">
                    @else
                        <img src="{{ url('/images/guitar-def.jpg') }}" alt="guitar poster">
                    @endif
                </div>
            </div>
            <div class="w-96">
                <h1>{{ $guitar->name }}</h1>
                <ul>
                    <li class="mt-3">Buy Now Price: €{{ $guitar->price }}</li>
                    <li class="mt-3">Current Bid: €{{ $current }}</li>
                    <li class="mt-3">Bid Expiration: {{ $guitar->bid_expiration }}</li>
                    <li class="mt-3">Condition: {{ $condition->condition }}</li>
                    <li class="mt-3">Type: {{ $type->type }}</li>
                    <li class="mt-3">Description: {{ $guitar->description }}</li>


                </ul>
                <ul>

                    {{-- if the user is authenticated load the correct link to account view / button to purchase / bid --}}
                    {{-- if not authenticated the user cannot view users accounts --}}
                    @switch((Auth::check()) ? (Auth::user()->role_id) : ('no role'))
                        {{-- user --}}
                        @case(1)
                            <li>
                                <button
                                    class="mt-4 bg-gray-700 hover:bg-white text-white hover:text-black font-bold py-1 border w-80"
                                    x-data="{}" x-on:click="window.livewire.emitTo('bid-modal', 'show')">

                                    Make Bid
                                </button>
                            </li>


                            <li>
                                <form action="{{ route('user-guitar.buy') }}">
                                    <input type="hidden" name="guitar_id" value="{{ $guitar->id }}">
                                    <button
                                        class="mt-1 hover:bg-gray-700 text-grey hover:text-white font-bold py-1 border border-black w-80"
                                        type="submit">

                                        Buy Now
                                    </button>
                                </form>
                            </li>
                            <a href="{{ route('user.account', ['user_id' => $user->id]) }}">
                                <li class="mt-3">Posted By: {{ $user->name }}</li>
                            </a>
                            <li><livewire:like-button :guitar="$guitar" :currentUser="Auth::user()" /> </li>
                            
                        @break

                        {{-- shop --}}
                        @case(2)
                            <a href="{{ route('shop.account', ['user_id' => $user->id]) }}">
                                <li class="mt-3">Posted By: {{ $user->name }}</li>

                            </a>
                            <li><livewire:like-button :guitar="$guitar" :currentUser="Auth::user()" /> </li>

                        @break

                        {{-- admin --}}
                        @case(3)
                        <li>
                            <button
                                class="mt-4 bg-gray-700 hover:bg-white text-white hover:text-black font-bold py-1 border w-80"
                                x-data="{}" x-on:click="window.livewire.emitTo('bid-modal', 'show')">

                                Make Bid
                            </button>
                        </li>


                        <li>
                            <form action="{{ route('admin-guitar.buy') }}">
                                <input type="hidden" name="guitar_id" value="{{ $guitar->id }}">
                                <button
                                    class="mt-1 hover:bg-gray-700 text-grey hover:text-white font-bold py-1 border border-black w-80"
                                    type="submit">

                                    Buy Now
                                </button>
                            </form>
                        </li>
                        <a href="{{ route('admin.account', ['user_id' => $user->id]) }}">
                            <li class="mt-3">Posted By: {{ $user->name }}</li>

                        </a>
                        <li><livewire:like-button :guitar="$guitar" :currentUser="Auth::user()" /> </li>
                        @break

                        {{-- no role --}}
                        @case('no role')
                            <li class="mt-3">Posted By: {{ $user->name }}</li>
                        @break

                        @default
                            default value
                        @break
                    @endswitch


                </ul>
            </div>
            <div>

            </div>
        </div>

        @if (Auth::check())
            <livewire:bid-modal :user_id="Auth::user()->id" :guitar_id="$guitar->id" />
        @endif
    </div>

</div>
@livewireScripts
