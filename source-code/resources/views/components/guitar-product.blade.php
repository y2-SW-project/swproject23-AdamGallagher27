<div>

    <div class="flex justify-center mt-10">
        {{-- {{ $guitar }} --}}
        <div class="grid grid-cols-2 gap-10">

            <div class="w-96">
                <div class="w-full">

                    <img src="{{ url('/images/shop.png') }}" alt="product image">
                </div>
            </div>
            <div class="w-96">
                <h1>{{ $guitar->name }}</h1>
                <ul>
                    <li class="mt-3">Buy Now Price: €{{ $guitar->price }}</li>
                    <li class="mt-3">Condition: {{ $condition->condition }}</li>
                    <li class="mt-3">Type: {{ $type->type }}</li>
                    <li class="mt-3">Posted By: {{ $user->name }}</li>
                    <li class="mt-3">Description: {{ $guitar->description }}</li>

                </ul>
                <ul>
                    <li><button class="mt-4 bg-gray-700 hover:bg-white text-white hover:text-black font-bold py-1 border w-80">
                        Make Bid
                      </button></li>
                      <li><button class="mt-1  hover:bg-gray-700 text-grey hover:text-white font-bold py-1 border border-black w-80">
                        Buy Now
                      </button></li>
                </ul>
            </div>
            <div>

            </div>
        </div>


    </div>


</div>
