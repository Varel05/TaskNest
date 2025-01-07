<x-guest-layout>
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">
            REGISTER
        </h1>
        <div class="w-28 h-0.5 mx-auto mt-0 bg-green-700"></div>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input id="name" type="text" name="name" 
            required class="mt-0.5 block w-full border-0 border-b-2 border-green-700 focus:ring-0 focus:border-green-700">
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <input id="email" type="email" name="email" 
            required class="mt-0.5 block w-full border-0 border-b-2 border-green-700 focus:ring-0 focus:border-green-700">
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input id="password" type="password" name="password" 
            required class="mt-0.5 block w-full border-0 border-b-2 border-green-700 focus:ring-0 focus:border-green-700">
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" 
            required class="mt-0.5 block w-full border-0 border-b-2 border-green-700 focus:ring-0 focus:border-green-700">
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center mt-6">
            <button type="submit" class="bg-green-700 text-white text-sm font-semibold px-6 py-2 rounded-full hover:bg-green-800">
                REGISTER
            </button>
        </div>
    </form>

    <div class="text-center mt-1">
        <a href="{{ route('login') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
            {{ __("I already have an account") }}
        </a>
    </div>
</x-guest-layout>


