<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\GroupMember;

class TaskController extends Controller
{
    // Menampilkan daftar tugas
    public function index(Request $request)
    {
        $project = Project::findOrFail($request->project_id);
        $tasks = Task::where('project_id', $request->project_id)
            ->where('assigned_to', $request->user_id)
            ->get();

            return view('tasks.index', compact('tasks', 'project'));
    }

    // Menampilkan form untuk membuat tugas
    public function create(Request $request)
    {
        $projectId = $request->project_id;
        $userId = $request->user_id;

        return view('tasks.create', [
            'projectId' => $projectId,
            'userId' => $userId,
        ]);
    }

    // Menyimpan tugas baru
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'assigned_to' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
        ]);

        Task::create([
            'project_id' => $request->project_id,
            'assigned_to' => $request->assigned_to,
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'due_date' => $request->due_date,
            'status' => 'pending',
            'priority' => $request->priority,
        ]);

        return redirect()->route('projects.show', $request->project_id)->with('success', 'Task added successfully!');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);

        // Ambil role pengguna terkait dengan project
        $project = $task->project; // Pastikan relasi `project` sudah didefinisikan di model `Task`
        $userRole = auth()->user()->groupMembers()
            ->where('project_id', $project->id)
            ->first()
            ->role ?? null;

        return view('tasks.show', compact('task', 'userRole'));
    }

    // Menampilkan form untuk submit tugas
    public function submit($taskId)
    {
        $task = Task::findOrFail($taskId);

        // Validasi: Hanya pengguna yang ditugaskan atau leader proyek yang dapat mengakses
        $isLeader = GroupMember::where('project_id', $task->project_id)
            ->where('user_id', auth()->id())
            ->where('role', 'leader')
            ->exists();

        if ($task->assigned_to != auth()->id() && !$isLeader) {
            abort(403, 'Unauthorized action.');
        }

        return view('tasks.submit', compact('task'));
    }

    public function storeSubmission(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);

        // Validasi: Hanya pengguna yang ditugaskan atau leader proyek yang dapat submit
        if ($task->assigned_to != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validasi input file
        $request->validate([
            'submission_file' => 'required|file|mimes:pdf,doc,docx,zip|max:2048',
        ]);

        // Simpan file submission ke direktori penyimpanan
        $filePath = $request->file('submission_file')->storeAs(
            'submissions',
            "task_{$taskId}_user_" . auth()->id() . '.' . $request->file('submission_file')->getClientOriginalExtension(),
            'public'
        );

        // Update task dengan file submission
        $task->update([
            'status' => 'done',
            'submission_file' => $filePath,
        ]);

        return redirect()->route('tasks.index', ['project_id' => $task->project_id, 'user_id' => auth()->id()])
            ->with('success', 'Task submitted successfully!');
    }


    public function edit($id)
    {
        $task = Task::findOrFail($id);

        // Cek apakah pengguna adalah member proyek dengan role leader
        $isLeader = GroupMember::where('project_id', $task->project_id)
            ->where('user_id', auth()->id())
            ->where('role', 'leader')
            ->exists();

        if ($task->assigned_to != auth()->id() && !$isLeader) {
            abort(403, 'Unauthorized action.');
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $taskId)
{
    $task = Task::findOrFail($taskId);

    // Pastikan pengguna memiliki izin untuk mengedit
   $isLeader = GroupMember::where('project_id', $task->project_id)
            ->where('user_id', auth()->id())
            ->where('role', 'leader')
            ->exists();

    // Validasi input
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'due_date' => 'required|date',
        'priority' => 'required|in:low,medium,high',
    ]);

    // Update task
    $task->update($request->only('title', 'description', 'due_date', 'priority'));

    return redirect()->route('tasks.index', ['project_id' => $task->project_id, 'user_id' => auth()->id()])
        ->with('success', 'Task updated successfully!');
}

}
