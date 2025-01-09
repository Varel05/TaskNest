@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Task Details</h1>
    <div class="mb-4">
        <h3>{{ $task->title }}</h3>
        <p>{{ $task->description }}</p>
        <p><strong>Due Date:</strong> {{ $task->due_date }}</p>
        <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
    </div>

    @if($userRole === 'leader')
        <div class="mb-4">
            <h4>Task Submissions</h4>
            @foreach($task->submissions as $submission)
                <p><strong>Submitted by:</strong> {{ $submission->user->name }}</p>
                <a href="{{ Storage::url($submission->file_path) }}" target="_blank">View Submission</a>
            @endforeach
        </div>
        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit Task</a>
    @elseif($userRole === 'member')
        @if($task->status === 'pending')
            <a href="{{ route('tasks.submit', $task->id) }}" class="btn btn-success">Submit Task</a>
        @else
            <p>Task has already been submitted.</p>
        @endif
    @endif
</div>
@endsection