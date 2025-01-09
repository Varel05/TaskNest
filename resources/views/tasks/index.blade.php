@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tasks for Project: {{ $project->name }}</h1>

    @foreach($tasks as $task)
        <div class="task-item">
            <h4>{{ $task->title }}</h4>
            <p>{{ $task->description }}</p>
            <p>Due Date: {{ $task->due_date }}</p>
            <p>Status: {{ ucfirst($task->status) }}</p>
            <p>Priority: {{ ucfirst($task->priority) }}</p>

            @if($task->status == 'pending' && $task->assigned_to == auth()->id())
                <a href="{{ route('tasks.submit', ['taskId' => $task->id]) }}" class="btn btn-primary">Submit Task</a>
            @endif

            @if($task->submission_file)
                <p>Submission File: <a href="{{ Storage::url($task->submission_file) }}" target="_blank">View Submission</a></p>
            @endif
        </div>
    @endforeach
</div>
@endsection
