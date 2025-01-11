@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Project Details</h1>

    <div class="mb-4">
        <h3>{{ $project->name }}</h3>
        <p>{{ $project->description }}</p>
        <p><strong>Start Date:</strong> {{ $project->start_date }}</p>
        <p><strong>End Date:</strong> {{ $project->end_date }}</p>
        <p><strong>Status:</strong> {{ ucfirst($project->status) }}</p>
    </div>

    @if($project->groupMembers->isNotEmpty())
    <h4>Members</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($project->groupMembers as $groupMember)
                <tr>
                    <td>
                        <a href="{{ route('tasks.index', ['project_id' => $project->id, 'user_id' => $groupMember->user_id]) }}">
                            {{ $groupMember->user->name }}
                        </a>                        
                    </td>
                    <td>{{ $groupMember->user->email }}</td>
                    <td>{{ $groupMember->role }}</td>
                    <td>
                        @if($groupMember->role == 'member')
                            <a href="{{ route('tasks.create', ['project_id' => $project->id, 'user_id' => $groupMember->user_id]) }}" class="btn btn-sm btn-success">Assign Task</a>
                            <form action="{{ route('projects.removeMember', ['project' => $project->id, 'user' => $groupMember->user_id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Kick</button>
                            </form>                            
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>No members found.</p>
    @endif

    @if($userRole === 'leader')
        <a href="{{ route('group-members.create', ['project_id' => $project->id]) }}" class="btn btn-secondary">Add Member</a>
        <!-- Tombol Delete Project -->
        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this project?');">
                Delete Project
            </button>
        </form>
        @endif
</div>
@endsection
