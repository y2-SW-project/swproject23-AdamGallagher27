<div>
    @if ($show)
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <div class="w-96 border-solid border-2 bg-gray-50">
                <button wire:click="$set('show', false)">escape</button>
                <div class="flex flex-col items-center p-12">

                    @switch(Auth::user()->role_id)
                        {{-- user --}}
                        @case(1)
                            <form action="{{ route('user-guitar.bid') }}">
                                <input class="w-80" type="text" name="bid_amount">
                                <input type="hidden" name="guitar_id" value={{ $guitar_id }}>
                                <input type="hidden" name="user_id" value={{ $user_id }}>
                                <button
                                    class="mt-4 bg-gray-700 hover:bg-white text-white hover:text-black font-bold py-1 border w-80"
                                    type="submit">Submit Bid</button>
                            </form>
                        @break

                        {{-- admin --}}
                        @case(3)
                            <form action="{{ route('admin-guitar.bid') }}">
                                <input class="w-80" type="text" name="bid_amount">
                                <input type="hidden" name="guitar_id" value={{ $guitar_id }}>
                                <input type="hidden" name="user_id" value={{ $user_id }}>
                                <button
                                    class="mt-4 bg-gray-700 hover:bg-white text-white hover:text-black font-bold py-1 border w-80"
                                    type="submit">Submit Bid</button>
                            </form>
                        @break

                        @default
                    @endswitch

                </div>
            </div>
        </div>
    @endif
</div>
