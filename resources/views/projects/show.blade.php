@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Proyek: {{ $project->name }}</h1>

    <div class="mb-4">
        <p><strong>Deskripsi:</strong> {{ $project->description }}</p>
        <p><strong>Tanggal Mulai:</strong> {{ $project->start_date }}</p>
        <p><strong>Tanggal Berakhir:</strong> {{ $project->end_date }}</p>
        <p><strong>Status:</strong> {{ ucfirst($project->status) }}</p>
        <p><strong>Dibuat Oleh:</strong> {{ $project->created_by }}</p>
    </div>

    <h3>Anggota Kelompok</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Peran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($project->groupMembers as $member)
                <tr>
                    <td>{{ $member->user->name }}</td>
                    <td>{{ ucfirst($member->role) }}</td>
                    <td>
                        <!-- Tombol Task, hanya bisa diakses oleh ketua tim -->
                        @if($member->role == 'leader')
                            <a href="{{ route('tasks.index', ['project_id' => $project->id, 'user_id' => $member->user_id]) }}" class="btn btn-info btn-sm">Task</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Add Member Button -->
    {{-- <div class="mt-6">
        <a href="{{ route('projects.addMember', $project->id) }}" 
            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Add Member
        </a>
    </div> --}}
    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
