@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <!-- Title -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6 dark:text-white">
            {{ isset($project) ? 'Edit Project' : 'Create Project' }}
        </h1>

        <!-- Form -->
        <form method="POST" action="{{ isset($project) ? route('projects.update', $project->id) : route('projects.store') }}" class="space-y-6 bg-white dark:bg-gray-900 border-2 p-6 shadow-lg rounded-lg">
            @csrf
            @if(isset($project))
                @method('PUT')
            @endif

            <!-- Name -->
            <div>
                <label for="name" class="block dark:text-white text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" 
                    id="name" 
                    name="name" 
                    value="{{ $project->name ?? '' }}" 
                    required 
                    class="w-full border-gray-300 dark:bg-gray-900 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-300">
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block dark:text-white text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea id="description" 
                    name="description" 
                    required 
                    class="w-full border-gray-300 dark:bg-gray-900 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-300">{{ $project->description ?? '' }}</textarea>
            </div>
            
                    <!-- Start Date -->
            <div>
            <label for="start_date" class="block dark:text-white text-sm font-medium text-gray-700 mb-1">Start Date</label>
            <input type="date" 
                id="start_date" 
                name="start_date" 
                value="{{ $project->start_date ?? '' }}" 
                required 
                class="w-full border-gray-300 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-300">
            </div>

            <!-- End Date -->
            <div>
            <label for="end_date" class="block dark:text-white text-sm font-medium text-gray-700 mb-1">End Date</label>
            <input type="date" 
                id="end_date" 
                name="end_date" 
                value="{{ $project->end_date ?? '' }}" 
                required 
                class="w-full border-gray-300 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-300">
            </div>

            <!-- Status -->
            <div>
            <label for="status" class="block dark:text-white text-sm font-medium text-gray-700 mb-1">Status</label>
            <select id="status" 
                name="status" 
                class="w-full border-gray-300 dark:bg-gray-900 dark:text-white rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-300">
                <option value="ongoing" {{ (isset($project) && $project->status == 'ongoing') ? 'selected' : '' }}>Ongoing</option>
                <option value="completed" {{ (isset($project) && $project->status == 'completed') ? 'selected' : '' }}>Completed</option>
            </select>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
            <button type="submit" 
                class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring focus:ring-green-300">
                Save
            </button>
            </div>
        </form>
    </div>
@endsection