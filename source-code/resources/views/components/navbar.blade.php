@vite('resources/js/app.js')

{{-- top half of nav bar --}}
<div>
    <div class="flex justify-between pt-2 pb-2 px-6 border-b-2">
        <h1 class='text-2xl'>Capo</h1>

        <div>
            <input placeholder="search for brands, models, make" class="rounded-none p-1 w-96 focus:outline-0
            " type="text">
        </div>

        <div>

            <div>
                @if (Route::has('login'))
                    <div class="">
                        @auth
                            {{-- if they are authenticated dont send them to dahsboard  --}}
                            {{-- only give them an opton to log out --}}
                            {{-- <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a> --}}
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log
                                in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- bottom half of nav bar --}}
    <div class="border-b-2">
        <ul class="flex ml-6 gap-4 my-2 ">
            <li>Electric</li>
            <li>Acoustic</li>
            <li>Hollow</li>
            <li>Classical</li>
            <li>Bass</li>
        </ul>
    </div>

</div>
