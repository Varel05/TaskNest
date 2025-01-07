@extends('layouts.app')

@section('content')
    <h1>Projects</h1>
    <a href="{{ route('projects.create') }}" class="btn btn-primary">Add Project</a>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->status }}</td>
                    <td>
                        <a href="{{ route('projects.show', $project->id) }}">View</a>
                        <a href="{{ route('projects.edit', $project->id) }}">Edit</a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection