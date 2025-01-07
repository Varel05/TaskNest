@extends('layouts.app')

@section('content')
    <h1>{{ $project->name }}</h1>
    <p>{{ $project->description }}</p>
    <p>Status: {{ $project->status }}</p>
    <p>Start Date: {{ $project->start_date }}</p>
    <p>End Date: {{ $project->end_date }}</p>
@endsection