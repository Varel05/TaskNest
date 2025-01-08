@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Group Members</h1>

    <a href="{{ route('group_members.create') }}" class="btn btn-primary mb-4">Add Group Member</a>

    <table class="table-auto w-full border">
        <thead>
            <tr>
                <th class="border px-4 py-2">Project</th>
                <th class="border px-4 py-2">User</th>
                <th class="border px-4 py-2">Role</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groupMembers as $member)
                <tr>
                    <td class="border px-4 py-2">{{ $member->project->name }}</td>
                    <td class="border px-4 py-2">{{ $member->user->name }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($member->role) }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('group_members.edit', $member->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('group_members.destroy', $member->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection