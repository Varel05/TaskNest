@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Add Group Member</h1>

    <form action="{{ route('group_members.store') }}" method="POST">
        @csrf
        <label for="project_id">Project:</label>
        <select name="project_id" id="project_id" required>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}">{{ $project->name }}</option>
            @endforeach
        </select>

        <label for="user_id">User:</label>
        <select name="user_id" id="user_id" required>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>

        <label for="role">Role:</label>
        <select name="role" id="role" required>
            <option value="member">Member</option>
            <option value="leader">Leader</option>
        </select>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
