@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tasks for Project: {{ $project->name }}</h1>

    @foreach($tasks as $task)
        <div class="task-item">
            <a href="{{ route('tasks.show', $task->id) }}" class="text-decoration-none">
                {{ $task->title }}
            </a>
            <p>{{ $task->description }}</p>
            <p>Due Date: {{ $task->due_date }}</p>
            <p>Status: {{ ucfirst($task->status) }}</p>
            <p>Priority: {{ ucfirst($task->priority) }}</p>

            @if($task->status == 'pending' && $task->assigned_to == auth()->id())
                <a href="{{ route('tasks.submit', ['task' => $task->id]) }}" class="btn btn-primary">Submit Task</a>
            @endif

            @if($task->submission_file)
                <p>Submission File: <a href="{{ Storage::url($task->submission_file) }}" target="_blank">View Submission</a></p>
            @endif
        </div>
    @endforeach
</div>
@endsection
