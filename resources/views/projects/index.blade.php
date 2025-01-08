@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($projects as $project)
            <div class="col-md-6 mb-4">
                <div class="card" onclick="window.location='{{ route('projects.show', $project->id) }}'" style="cursor: pointer;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->name }}</h5>
                        <p class="card-text">
                            <strong>End Date:</strong> {{ $project->end_date }}<br>
                            <strong>Created By:</strong> {{ $project->user->name }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection