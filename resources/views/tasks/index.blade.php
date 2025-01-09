@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Task untuk {{ $user->name }}</h1>

        @auth
            @if(Auth::user()->id == $project->groupMembers->where('role', 'leader')->first()->user_id)
                <div class="mb-4">
                    <a href="{{ route('tasks.create', ['project_id' => $project->id, 'user_id' => $user->id]) }}" class="btn btn-primary">Tambah Tugas</a>
                </div>
            @endif
        @endauth

        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">Judul</th>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">Deskripsi</th>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">Status</th>
                        <th class="px-4 py-2 border border-gray-200 text-left text-sm font-medium text-gray-700">Prioritas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr class="odd:bg-white even:bg-gray-50">
                            <td class="px-4 py-2 border border-gray-200 text-sm text-gray-800">{{ $task->title }}</td>
                            <td class="px-4 py-2 border border-gray-200 text-sm text-gray-800">{{ $task->description }}</td>
                            <td class="px-4 py-2 border border-gray-200 text-sm text-gray-800">
                                <span class="px-2 py-1 rounded-lg text-white {{ $task->status === 'completed' ? 'bg-green-500' : 'bg-yellow-500' }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border border-gray-200 text-sm text-gray-800">
                                <span class="px-2 py-1 rounded-lg {{ $task->priority === 'high' ? 'bg-red-500 text-white' : 'bg-gray-300 text-gray-700' }}">
                                    {{ ucfirst($task->priority) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
