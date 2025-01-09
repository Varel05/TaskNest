@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Comments</h1>

    <form action="{{ route('comments.store', $task->id) }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <textarea name="comment" class="form-control" rows="3" placeholder="Write a comment..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Comment</button>
    </form>

    <h3>All Comments</h3>
    @if($task->comments->isEmpty())
        <p>No comments yet.</p>
    @else
        <ul class="list-group">
            @foreach($task->comments as $comment)
                <li class="list-group-item">
                    <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}
                    <br><small>{{ $comment->created_at->diffForHumans() }}</small>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection