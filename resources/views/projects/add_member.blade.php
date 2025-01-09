@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Member to Project: {{ $project->name }}</h1>
    <form action="{{ route('projects.storeMember', $project->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">Select User</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">-- Select User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="role" value="member">
        <button type="submit" class="btn btn-primary">Add Member</button>
    </form>
</div>
@endsection