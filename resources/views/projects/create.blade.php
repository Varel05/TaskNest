@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Card Container -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Create Project
                </h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Fill in the project details to get started
                </p>
            </div>

            <!-- Form -->
            <form action="{{ route('projects.store') }}" method="POST">
                @csrf
                
                <!-- Project Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Project Name
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        required
                        class="block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-green-500 dark:focus:border-green-400 focus:ring-2 focus:ring-green-200 dark:focus:ring-green-800 focus:ring-opacity-50 transition-colors duration-200"
                        placeholder="Enter project name"
                    >
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Description
                    </label>
                    <textarea 
                        name="description" 
                        id="description" 
                        rows="4" 
                        required
                        class="block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-green-500 dark:focus:border-green-400 focus:ring-2 focus:ring-green-200 dark:focus:ring-green-800 focus:ring-opacity-50 transition-colors duration-200"
                        placeholder="Enter project description"
                    ></textarea>
                </div>

                <!-- Date Range -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Start Date -->
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Start Date
                        </label>
                        <input 
                            type="date" 
                            name="start_date" 
                            id="start_date" 
                            required
                            class="block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-green-500 dark:focus:border-green-400 focus:ring-2 focus:ring-green-200 dark:focus:ring-green-800 focus:ring-opacity-50 transition-colors duration-200"
                        >
                    </div>

                    <!-- End Date -->
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            End Date
                        </label>
                        <input 
                            type="date" 
                            name="end_date" 
                            id="end_date" 
                            required
                            class="block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-green-500 dark:focus:border-green-400 focus:ring-2 focus:ring-green-200 dark:focus:ring-green-800 focus:ring-opacity-50 transition-colors duration-200"
                        >
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button 
                        type="submit"
                        class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-400 transition-colors duration-200"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        Next
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection