@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Task</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <input type="hidden" name="project_id" value="{{ $projectId }}">
        <input type="hidden" name="assigned_to" value="{{ $userId }}">
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="date" class="form-control" id="due_date" name="due_date" required>
        </div>
        <div class="form-group">
            <label for="priority">Priority</label>
            <select class="form-control" id="priority" name="priority" required>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save Task</button>
    </form>        
</div>
@endsection
