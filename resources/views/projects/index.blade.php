@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($projects as $project)
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden cursor-pointer transform hover:scale-105 transition duration-300" onclick="window.location='{{ route('projects.show', $project->id) }}'">
                <div class="p-6">
                    <h5 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2">{{ $project->name }}</h5>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">
                        <strong class="font-medium text-gray-800 dark:text-gray-100">End Date:</strong> {{ $project->end_date }}<br>
                        <strong class="font-medium text-gray-800 dark:text-gray-100">Created By:</strong> {{ $project->user->name }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
