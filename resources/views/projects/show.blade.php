@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-8 p-6 bg-white dark:bg-gray-900 border-2 shadow-md rounded-lg">
        <!-- Title -->
        <h1 class="text-3xl font-bold dark:text-white text-gray-800 mb-4">{{ $project->name }}</h1>

        <!-- Description -->
        <p class="dark:text-white text-gray-600 mb-6">{{ $project->description }}</p>

        <!-- Status -->
        <div class="mb-4">
            <span class="inline-block px-4 py-2 text-sm font-semibold rounded-full 
                {{ $project->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                {{ ucfirst($project->status) }}
            </span>
        </div>

        <!-- Dates -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm font-medium dark:text-white text-gray-500">Start Date</p>
                <p class="dark:text-white text-gray-800">{{ \Carbon\Carbon::parse($project->start_date)->format('F j, Y') }}</p>
            </div>
            <div>
                <p class="text-sm font-medium dark:text-white text-gray-500">End Date</p>
                <p class="dark:text-white text-gray-800">{{ \Carbon\Carbon::parse($project->end_date)->format('F j, Y') }}</p>
            </div>
        </div>
    </div>
@endsection
