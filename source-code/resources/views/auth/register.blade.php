<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <input type="text" id="name" class="rounded block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus >
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />

            <input type="text" id="email" class="rounded block mt-1 w-full" type="email" name="email" :value="old('email')" required>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Description -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />

                            <input type="text" id="description" class="rounded block mt-1 w-full"
                            type="text"
                            name="description" >

            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- role -->
        <div class="mt-4">
            <x-input-label for="role_id" :value="__('Role')" />

            <select name="role_id" id="role_id" class="rounded block mt-1 w-full">
                <option value="1">User</option>
                <option value="2">Shop</option>
            </select>

            <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <input type="text" id="password" class="rounded block mt-1 w-full"
            type="password"
            name="password"
            required autocomplete="new-password" >

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <input type="text" id="password_confirmation" class="rounded block mt-1 w-full"
            type="password"
            name="password_confirmation" required>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button class="ml-4 bg-main px-5 py-2 rounded text-white">
                {{ __('Register') }}
            </button>

            {{-- <x-primary-button class="ml-4 bg-main">
                {{ __('Register') }}
            </x-primary-button> --}}
        </div>
    </form>
</x-guest-layout>
