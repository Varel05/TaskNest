@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Task Details</h1>
        <h2 class="text-2xl text-green-600 dark:text-green-400 font-semibold">{{ $task->title }}</h2>
    </div>

    <!-- Task Information Card -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
        <div class="prose dark:prose-invert max-w-none mb-6">
            <p class="text-gray-700 dark:text-gray-300">{{ $task->description }}</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="text-gray-600 dark:text-gray-400 font-medium">Due Date:</span>
                <span class="text-gray-800 dark:text-gray-200">{{ $task->due_date }}</span>
            </div>
            
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-gray-600 dark:text-gray-400 font-medium">Status:</span>
                <span class="px-2 py-1 rounded-full text-sm
                    @if($task->status == 'done')
                        bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                    @elseif($task->status == 'in_progress')
                        bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200
                    @else
                        bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200
                    @endif">
                    {{ ucfirst($task->status) }}
                </span>
            </div>
            
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

        <!-- Submission Section -->
        <div class="border-t dark:border-gray-700 pt-4">
            @if($task->submissions()->exists())
                @php
                    $submission = $task->submissions()->latest()->first();
                @endphp
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="text-gray-600 dark:text-gray-400 font-medium">Submission File:</span>
                    <a href="{{ Storage::url($submission->file_path) }}" 
                       target="_blank"
                       class="text-green-600 dark:text-green-400 hover:text-green-700 dark:hover:text-green-300 transition duration-150">
                        View Submission
                    </a>
                </div>
            @else
                <p class="text-gray-500 dark:text-gray-400">No submission file available.</p>
            @endif
        </div>
    </div>

    <!-- Edit Button for Leader -->
    @if($userRole === 'leader')
        <div class="mb-8">
            <a href="{{ route('tasks.edit', $task->id) }}" 
               class="inline-flex items-center px-4 py-2 bg-yellow-500 dark:bg-yellow-600 text-white rounded-lg hover:bg-yellow-600 dark:hover:bg-yellow-700 transition duration-150">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Task
            </a>
        </div>
    @endif

    <!-- Comments Section -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">Comments</h4>
        
        <div class="space-y-6 mb-8">
            @foreach($task->comments as $comment)
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <div class="flex items-center mb-2">
                        <span class="font-semibold text-gray-800 dark:text-white">{{ $comment->user->name }}</span>
                        <span class="text-gray-500 dark:text-gray-400 text-sm ml-2">says:</span>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300 mb-2">{{ $comment->comment }}</p>
                    <small class="text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
            @endforeach
        </div>

        <!-- Comment Form -->
        <form action="{{ route('comments.store', $task->id) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Add a comment
                </label>
                <textarea
                    name="comment"
                    id="comment"
                    rows="3"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-green-500 focus:ring-green-500"
                    required
                ></textarea>
            </div>
            <button type="submit" 
                    class="inline-flex items-center px-4 py-2 bg-green-600 dark:bg-green-500 text-white rounded-lg hover:bg-green-700 dark:hover:bg-green-600 transition duration-150">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Add Comment
            </button>
        </form>
    </div>
</div>
@endsection