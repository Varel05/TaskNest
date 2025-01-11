@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Card Container -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Add Members to Project
                </h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Select team members to add to your project
                </p>
            </div>

            <!-- Form -->
            <form action="{{ route('group-members.store') }}" method="POST">
                @csrf
                <input type="hidden" name="project_id" value="{{ $projectId }}">
                
                <div id="member-forms" class="space-y-4">
                    <div class="member-form-group">
                        <label for="user_ids[]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Select Member
                        </label>
                        <select 
                            name="user_ids[]" 
                            class="block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-green-500 dark:focus:border-green-400 focus:ring-2 focus:ring-green-200 dark:focus:ring-green-800 focus:ring-opacity-50 transition-colors duration-200"
                        >
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Button Group -->
                <div class="mt-6 flex items-center space-x-4">
                    <button 
                        type="button" 
                        id="add-member-form"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-green-400 transition-colors duration-200"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Add More Members
                    </button>
                    
                    <button 
                        type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-400 transition-colors duration-200"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('add-member-form').addEventListener('click', function() {
    const memberForm = document.querySelector('.member-form-group').cloneNode(true);
    memberForm.querySelector('select').value = ''; // Reset selection
    document.getElementById('member-forms').appendChild(memberForm);
});
</script>
@endsection