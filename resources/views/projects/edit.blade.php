@extends('layouts.app')

@section('content')
    <h1>{{ isset($project) ? 'Edit Project' : 'Create Project' }}</h1>
    <form method="POST" action="{{ isset($project) ? route('projects.update', $project->id) : route('projects.store') }}">
        @csrf
        @if(isset($project))
            @method('PUT')
        @endif
        <label>Name</label>
        <input type="text" name="name" value="{{ $project->name ?? '' }}" required>
        
        <label>Description</label>
        <textarea name="description" required>{{ $project->description ?? '' }}</textarea>
        
        <label>Start Date</label>
        <input type="date" name="start_date" value="{{ $project->start_date ?? '' }}" required>
        
        <label>End Date</label>
        <input type="date" name="end_date" value="{{ $project->end_date ?? '' }}" required>
        
        <label>Status</label>
        <select name="status">
            <option value="ongoing" {{ (isset($project) && $project->status == 'ongoing') ? 'selected' : '' }}>Ongoing</option>
            <option value="completed" {{ (isset($project) && $project->status == 'completed') ? 'selected' : '' }}>Completed</option>
        </select>
        
        <button type="submit">Save</button>
    </form>
@endsection