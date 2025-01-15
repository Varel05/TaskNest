<x-guest-layout>
    <div class="text-center mb-8 mt-4">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
            FORGOT PASSWORD
        </h1>
        <div class="w-60 h-0.5 mx-auto mt-0 bg-green-700"></div>
    </div>

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 text-center">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-white">Email Address</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus
                class="mt-2 block w-full border-0 border-b-2 border-green-700 focus:outline-none focus:ring-0 focus:border-green-700">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center mt-8 mb-4">
            <button type="submit" class="bg-green-700 text-white text-sm font-semibold px-6 py-2 rounded-full hover:bg-green-800">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>
    </form>
</x-guest-layout>
