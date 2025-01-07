<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Title -->
    <div class="text-center mb-10">
        <h1 class="text-2xl font-bold text-gray-800">
            LOGIN
        </h1>
        <div class="w-20 h-0.5 mx-auto mt-0 bg-green-700"></div>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" type="email" name="email" 
                value="{{ old('email') }}" 
                required autofocus class="w-full mt-1 border-0 border-b-2 border-green-700 focus:outline-none focus:ring-0 focus:border-green-500" />
            @error('email')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input id="password" type="password" name="password" 
                required class="w-full mt-1 border-0 border-b-2 border-green-700 focus:outline-none focus:ring-0 focus:border-green-500" />
            @error('password')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Forgot Password and Remember Me -->
        <div class="flex justify-between mt-2">
            <div>
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-green-600 shadow-sm focus:ring-green-500 dark:focus:ring-green-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>
            <div class="text-right">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </div>

        <!-- Login Button -->
        <div class="flex justify-center mt-10">
            <x-primary-button class="bg-green-700 text-white hover:bg-green-800 px-6 py-2 rounded-md">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Register Button -->
        <div class="text-center mt-4">
            <a href="{{ route('register') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __("Don't have an account yet?") }}
            </a>
        </div>
    </form>
</x-guest-layout>


