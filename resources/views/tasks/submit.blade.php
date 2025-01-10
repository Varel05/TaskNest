@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Submit Task</h1>
    <p><strong>Task:</strong> {{ $task->title }}</p>
    <p>{{ $task->description }}</p>
    <p><strong>Due Date:</strong> {{ $task->due_date }}</p>

    @if ($task->status != 'pending')
        <p class="text-success">Task already submitted.</p>
        <p>Submission File: <a href="{{ Storage::url($task->submission_file) }}" target="_blank">View Submission</a></p>
    @else
        <form action="{{ route('tasks.submit', ['task' => $task->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="submission_file">Upload Submission File</label>
                <input type="file" class="form-control" id="submission_file" name="submission_file" accept=".pdf,.doc,.docx,.zip" required>
                @error('submission_file')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    @endif
</div>
@endsection
