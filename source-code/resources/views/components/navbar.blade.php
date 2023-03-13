<div>

    {{-- top half of nav bar --}}
    <div>
        <h1>Capo</h1>

        <div>
            <input type="text">
        </div>

        <div>

            {{--         <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
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
 --}}
            <button>heart</button>
            <button>sign up</button>
            <button>log in</button>
        </div>
    </div>

    {{-- bottom half of nav bar --}}
    <div>
        <ul>
            <li>Electric</li>
            <li>Acoustic</li>
            <li>Hollow</li>
            <li>Classical</li>
            <li>Bass</li>
        </ul>
    </div>

</div>