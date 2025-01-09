@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Submit Task: {{ $task->title }}</h1>

    <form action="{{ route('tasks.storeSubmission', ['taskId' => $task->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="submission_file">Upload File Submission</label>
            <input type="file" name="submission_file" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-success mt-3">Submit</button>
    </form>
</div>
@endsection
