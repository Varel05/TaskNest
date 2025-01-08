@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tugas untuk {{ $user->name }} di Proyek: {{ $project->name }}</h1>

    @if ($isLeader)
        <!-- Tombol Tambah Tugas -->
        <a href="{{ route('tasks.create', ['project_id' => $project->id, 'user_id' => $user->id]) }}" class="btn btn-primary mb-3">
            Tambah Tugas
        </a>
    @endif

    <!-- Tabel Task -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Prioritas</th>
                <th>Status</th>
                <th>Deadline</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ ucfirst($task->priority) }}</td>
                    <td>{{ ucfirst($task->status) }}</td>
                    <td>{{ $task->due_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection