<div class="flex flex-col items-center">
        
        {{-- <img src="{{ $img }}" alt="image of product">
         --}}
         <div class="w-48">
                <div class="w-full">
                    @if (file_exists(public_path('storage/images/' . $guitar->image)))
                        <img src="{{ asset('storage/images/' . $guitar->image) }}" alt="guitar poster">
                    @else
                        <img src="{{ url('/images/home-' . rand(1, 6) . '.png') }}" alt="guitar poster">
                    @endif
                </div>
        </div>
        <p>{{ $guitar->name }}</p>
</div>