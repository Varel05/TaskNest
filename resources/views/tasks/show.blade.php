@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Task Details</h1>
    <h2>{{ $task->title }}</h2>
    <p>{{ $task->description }}</p>
    <p><strong>Due Date:</strong> {{ $task->due_date }}</p>
    <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
    <p><strong>Priority:</strong> {{ ucfirst($task->priority) }}</p>

    @if($task->submission_file)
        <p><strong>Submission File:</strong> 
            <a href="{{ Storage::url($task->submission_file) }}" target="_blank">View Submission</a>
        </p>
    @endif

    @if($userRole === 'leader')
        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit Task</a>
    @endif
    
    <!-- Menampilkan komentar yang sudah ada -->
    <h4>Comments</h4>
    @foreach($task->comments as $comment)
        <div class="comment">
            <p><strong>{{ $comment->user->name }}</strong> says:</p>
            <p>{{ $comment->comment }}</p>
            <small>{{ $comment->created_at->diffForHumans() }}</small>
        </div>
    @endforeach

    <!-- Form untuk menambahkan komentar -->
    <form action="{{ route('comments.store', $task->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <textarea name="comment" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Comment</button>
    </form>
</div>
@endsection