<!-- tasks/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Task untuk {{ $user->name }}</h1>
        @auth
            @if(Auth::user()->id == $project->groupMembers->where('role', 'leader')->first()->user_id)
                <a href="{{ route('tasks.create', $project_id) }}" class="btn btn-primary">Tambah Tugas</a>
            @endif
        @endauth
        <table class="table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Prioritas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ ucfirst($task->status) }}</td>
                        <td>{{ ucfirst($task->priority) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
