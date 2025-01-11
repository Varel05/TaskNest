@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-8">Tugas Kamu Pada Project : {{ $project->name }}</h1>

    <div class="grid gap-6">
        @foreach($tasks as $task)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300">
                <div class="flex justify-between items-start mb-4">
                    <a href="{{ route('tasks.show', $task->id) }}" class="text-xl font-semibold text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 transition">
                        {{ $task->title }}
                    </a>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                        </svg>
                        <span class="text-gray-600 dark:text-gray-400 font-medium">Priority:</span>
                        <span class="px-2 py-1 rounded-full text-sm
                            @if($task->priority == 'high')
                                bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200
                            @elseif($task->priority == 'medium')
                                bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200
                            @else
                                bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                            @endif">
                            {{ ucfirst($task->priority) }}
                        </span>
                    </div>
                </div>

                <p class="text-gray-600 dark:text-gray-300 mb-4">{{ $task->description }}</p>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-gray-700 dark:text-gray-300">Due: {{ $task->due_date }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="px-2.5 py-0.5 rounded-full text-sm font-medium
                            @if($task->status == 'completed')
                                bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                            @elseif($task->status == 'in_progress')
                                bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200
                            @else
                                bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200
                            @endif">
                            {{ ucfirst($task->status) }}
                        </span>
                    </div>
                </div>

                <div class="flex flex-wrap gap-4">
                    @if($task->status == 'pending' && $task->assigned_to == auth()->id())
                        <a href="{{ route('tasks.submit', ['task' => $task->id]) }}" 
                           class="inline-flex items-center px-4 py-2 bg-green-600 dark:bg-green-500 hover:bg-green-700 dark:hover:bg-green-600 text-white font-medium rounded-lg transition duration-150 ease-in-out">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Submit Task
                        </a>
                    @endif

                    @if($task->submission_file)
                        <a href="{{ Storage::url($task->submission_file) }}" 
                           target="_blank"
                           class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-medium rounded-lg transition duration-150 ease-in-out">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            View Submission
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection