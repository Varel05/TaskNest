<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TaskNest - Group Task Management</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('\images\logo-shortcut.ico') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased min-h-screen bg-green-50 dark:bg-gray-900">
        <!-- Background Pattern -->
        <div class="absolute inset-0 -z-10 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-green-400 dark:from-gray-900 dark:to-gray-800"></div>
        </div>

        <div class="relative min-h-screen flex flex-col">
            <!-- Header -->
            <header class="relative z-50 w-full border-b border-green-200 dark:border-gray-800 bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm">
                <div class="max-w-7xl mx-auto">
                    <div class="flex justify-between items-center h-16 px-4 sm:px-6 lg:px-8">
                        <!-- Left side: Logo -->
                        <div class="flex items-center">
                            <a href="{{ route('dashboard') }}" class="flex items-center">
                                <x-application-logo class="block h-8 w-auto" />
                            </a>
                        </div>

                        <!-- Center: Theme Switcher -->
                        <div class="absolute left-1/2 transform -translate-x-1/2">
                            <button type="button" 
                                    class="hs-dark-mode-active:hidden block p-2 rounded-full hover:bg-green-100 dark:hover:bg-gray-800 focus:outline-none"
                                    data-hs-theme-click-value="dark">
                                <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                </svg>
                            </button>
                            <button type="button"
                                    class="hs-dark-mode-active:block hidden p-2 rounded-full hover:bg-green-100 dark:hover:bg-gray-800 focus:outline-none"
                                    data-hs-theme-click-value="light">
                                <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Right side: Navigation Links -->
                        @if (Route::has('login'))
                            <nav class="flex items-center gap-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" 
                                       class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" 
                                       class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">
                                        Log in
                                    </a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" 
                                           class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-grow flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-green-50 to-white dark:from-gray-800 dark:to-gray-900">
                <div class="max-w-3xl mx-auto text-center">
                    <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 dark:text-white mb-6 animate-fade-in">
                        Welcome to <span class="text-green-500">TaskNest</span>
                    </h1>
                    <p id="typing-text" class="text-lg text-gray-600 dark:text-gray-400 mb-8 leading-relaxed">
                        <!-- Text will be animated here -->
                    </p>
                    <div class="flex justify-center">
                        <a href="{{ route('register') }}" 
                        class="inline-flex items-center justify-center px-8 py-3 text-base font-semibold text-white bg-green-500 hover:bg-green-600 transition duration-300 rounded-lg shadow-md dark:shadow-none hover:shadow-lg dark:hover:shadow-green-500/50 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-700">
                            Get Started
                        </a>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="relative z-50 py-8 bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center text-sm text-gray-600">
                        &copy; <span id="current-year"></span> TaskNest. All rights reserved.
                    </div>
                </div>
            </footer>

            <script>
                // Smooth fade-in animation
                document.addEventListener('DOMContentLoaded', () => {
                    const fadeElements = document.querySelectorAll('.animate-fade-in');
                    fadeElements.forEach(el => {
                        el.style.opacity = 0;
                        el.style.transition = 'opacity 1.5s ease-in-out';
                        setTimeout(() => (el.style.opacity = 1), 300);
                    });

                    // Typing effect
                    const typingText = "Permudah pengelolaan tugas kelompok Anda. Kolaborasi, atur, dan capai lebih banyak bersama.";
                    const typingElement = document.getElementById('typing-text');
                    let charIndex = 0;

                    function typeEffect() {
                        if (charIndex < typingText.length) {
                            typingElement.textContent += typingText.charAt(charIndex);
                            charIndex++;
                            setTimeout(typeEffect, 50); // Adjust typing speed here (50ms per character)
                        }
                    }
                    typeEffect();
                });

                // Dynamic year update
                const yearSpan = document.getElementById('current-year');
                yearSpan.textContent = new Date().getFullYear();
            </script>
        </div>
    </body>
</html>