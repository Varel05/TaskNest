@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($projects->isEmpty())
        <p>No projects found. <a href="{{ route('projects.create') }}">Create a new project</a></p>
    @else
        <div class="row">
            @foreach($projects as $project)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->name }}</h5>
                            <p class="card-text">{{ $project->description }}</p>
                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection