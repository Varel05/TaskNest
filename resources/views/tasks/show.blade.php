<h3>Task untuk {{ $tasks->first()->user->name }}</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Prioritas</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->due_date }}</td>
                <td>{{ ucfirst($task->status) }}</td>
                <td>{{ ucfirst($task->priority) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Tombol tambah tugas hanya untuk leader tim -->
@if(Auth::user()->role == 'leader')
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Tambah Tugas</a>
@endif