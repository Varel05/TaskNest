@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">Submit Task</h1>
        
        <div class="bg-green-50 dark:bg-green-900/30 rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold text-green-800 dark:text-green-200 mb-2">{{ $task->title }}</h2>
            <p class="text-green-700 dark:text-green-300">{{ $task->description }}</p>
            <div class="flex items-center text-green-700 dark:text-green-300 mt-4">
                <span class="font-medium">Due Date:</span>
                <span class="ml-2">{{ $task->due_date }}</span>
            </div>
        </div>

        @if ($task->status != 'done')
            @if ($task->status != 'pending')
                <div class="bg-yellow-100 dark:bg-yellow-900/50 border-l-4 border-yellow-500 p-4 mb-6">
                    <p class="text-yellow-700 dark:text-yellow-300 font-medium">Task already submitted. You can resubmit if needed.</p>
                    <a href="{{ Storage::url($task->submission->file_path) }}"
                       target="_blank" 
                       class="text-yellow-600 hover:text-yellow-800 dark:text-yellow-400 dark:hover:text-yellow-300">
                        View Previous Submission
                    </a>
                </div>
            @endif
            <form action="{{ route('tasks.submit', ['task' => $task->id]) }}" 
                method="POST" 
                enctype="multipart/form-data"
                class="space-y-6">
              @csrf
              <div>
                  <label for="submission_file" 
                         class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                      Upload Submission File
                  </label>
                  <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg hover:border-green-500 dark:hover:border-green-400 transition-colors duration-200">
                      <div class="space-y-1 text-center">
                          <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                              <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" 
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                          </svg>
                          <div class="flex text-sm text-gray-600 dark:text-gray-400">
                              <label for="submission_file" 
                                     class="relative cursor-pointer rounded-md font-medium text-green-600 dark:text-green-400 hover:text-green-500 dark:hover:text-green-300 focus-within:outline-none">
                                  <span>Upload a file</span>
                                  <input id="submission_file"
                                         name="submission_file"
                                         type="file"
                                         accept=".pdf,.doc,.docx,.zip"
                                         class="sr-only"
                                         required
                                         onchange="displayFileName(this)">
                              </label>
                              <p class="pl-1">or drag and drop</p>
                          </div>
                          <p id="file-name" class="text-xs text-gray-500 dark:text-gray-400">
                              No file chosen
                          </p>
                      </div>
                  </div>
                  @error('submission_file')
                      <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                  @enderror
              </div>

              <div class="flex justify-end">
                  <button type="submit" 
                          class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 dark:bg-green-500 hover:bg-green-700 dark:hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-800 transition-colors duration-200">
                      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                      </svg>
                      Submit Task
                  </button>
              </div>
          </form>
        @else
            <div class="bg-green-100 dark:bg-green-900/50 border-l-4 border-green-500 p-4 mb-6">
                <p class="text-green-700 dark:text-green-300 font-medium">Task marked as done. No further submissions are allowed.</p>
            </div>
        @endif
    </div>
</div>

<script>
    function displayFileName(input) {
        const fileName = input.files[0]?.name || "No file chosen";
        document.getElementById('file-name').textContent = fileName;
    }
</script>
@endsection