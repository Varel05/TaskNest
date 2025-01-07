@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-8 p-6 bg-white shadow-md dark:bg-gray-900 border-2 rounded-lg">
        <!-- Title -->
        <h1 class="text-2xl font-semibold dark:text-white text-gray-800 mb-6">
            {{ isset($project) ? 'Edit Project' : 'Create Project' }}
        </h1>

        <!-- Form -->
        <form method="POST" action="{{ isset($project) ? route('projects.update', $project->id) : route('projects.store') }}" class="space-y-6">
            @csrf
            @if(isset($project))
                @method('PUT')
            @endif

            <!-- Name -->
            <div>
                <label for="name" class="block dark:text-white text-sm font-medium text-gray-700 mb-2">Name</label>
                <input type="text" 
                    id="name" 
                    name="name" 
                    value="{{ $project->name ?? '' }}" 
                    required 
                    class="w-full px-4 py-2 border dark:text-white border-gray-300 dark:bg-gray-900 rounded-md focus:ring focus:ring-green-200 focus:border-green-500">
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block dark:text-white text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea id="description" 
                    name="description" 
                    rows="4" 
                    required 
                    class="w-full px-4 py-2 border dark:text-white border-gray-300 dark:bg-gray-900 rounded-md focus:ring focus:ring-green-200 focus:border-green-500">{{ $project->description ?? '' }}</textarea>
            </div>

            <!-- Start Date -->
            <div>
                <label for="start_date" class="block dark:text-white text-sm font-medium text-gray-700 mb-2">Start Date</label>
                <input type="date" 
                    id="start_date" 
                    name="start_date" 
                    value="{{ $project->start_date ?? '' }}" 
                    required 
                    class="w-full px-4 py-2 border dark:text-white border-gray-300 dark:bg-gray-900 rounded-md focus:ring focus:ring-green-200 focus:border-green-500">
            </div>

            <!-- End Date -->
            <div>
                <label for="end_date" class="block dark:text-white text-sm font-medium text-gray-700 mb-2">End Date</label>
                <input type="date" 
                    id="end_date" 
                    name="end_date" 
                    value="{{ $project->end_date ?? '' }}" 
                    required 
                    class="w-full px-4 py-2 border dark:text-white border-gray-300 dark:bg-gray-900 rounded-md focus:ring focus:ring-green-200 focus:border-green-500">
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block dark:text-white text-sm font-medium text-gray-700 mb-2">Status</label>
                <select id="status" 
                    name="status" 
                    class="w-full px-4 py-2 border dark:text-white border-gray-300 dark:bg-gray-900 rounded-md focus:ring focus:ring-green-200 focus:border-green-500">
                    <option value="ongoing" {{ (isset($project) && $project->status == 'ongoing') ? 'selected' : '' }}>Ongoing</option>
                    <option value="completed" {{ (isset($project) && $project->status == 'completed') ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" 
                    class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring focus:ring-green-300">
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection
