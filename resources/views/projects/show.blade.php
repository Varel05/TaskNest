@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100">Project Details</h1>
        
        @if($userRole === 'leader')
        <!-- Delete Project Button -->
        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    onclick="return confirm('Are you sure you want to delete this project? This action cannot be undone.')"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:focus:ring-offset-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                Delete Project
            </button>
        </form>
        @endif
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-8">
        <h3 class="text-2xl font-semibold text-green-700 dark:text-green-500 mb-4">{{ $project->name }}</h3>
        <p class="text-gray-600 dark:text-gray-300 mb-4">{{ $project->description }}</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div class="bg-green-50 dark:bg-green-900/30 rounded-lg p-4">
                <p class="text-green-700 dark:text-green-400 font-medium">Start Date</p>
                <p class="text-gray-700 dark:text-gray-300">{{ $project->start_date }}</p>
            </div>
            <div class="bg-green-50 dark:bg-green-900/30 rounded-lg p-4">
                <p class="text-green-700 dark:text-green-400 font-medium">End Date</p>
                <p class="text-gray-700 dark:text-gray-300">{{ $project->end_date }}</p>
            </div>
            <div class="bg-green-50 dark:bg-green-900/30 rounded-lg p-4">
                <p class="text-green-700 dark:text-green-400 font-medium">Status</p>
                <p class="text-gray-700 dark:text-gray-300">{{ ucfirst($project->status) }}</p>
            </div>
        </div>
    </div>

    @if($project->groupMembers->isNotEmpty())
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Members</h4>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-green-50 dark:bg-green-900/30">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-400 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-400 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-400 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($project->groupMembers as $groupMember)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('tasks.index', ['project_id' => $project->id, 'user_id' => $groupMember->user_id]) }}" 
                                   class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300">
                                    {{ $groupMember->user->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-300">{{ $groupMember->user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-300">{{ $groupMember->role }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($groupMember->role == 'member')
                                    <div class="flex space-x-2">
                                        <a href="{{ route('tasks.create', ['project_id' => $project->id, 'user_id' => $groupMember->user_id]) }}" 
                                           class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-900">
                                            Assign Task
                                        </a>
                                        <form action="{{ route('projects.removeMember', ['project' => $project->id, 'user' => $groupMember->user_id]) }}" 
                                              method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:focus:ring-offset-gray-900">
                                                Kick
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 text-center">
            <p class="text-gray-600 dark:text-gray-300">No members found.</p>
        </div>
    @endif

    @if($userRole === 'leader')
        <div class="mt-8">
            <a href="{{ route('group-members.create', ['project_id' => $project->id]) }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-900">
                Add Member
            </a>
        </div>
    @endif
</div>
@endsection