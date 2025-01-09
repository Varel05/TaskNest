<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; // Pastikan model Task sudah di-import

class TaskController extends Controller
{
    // Menampilkan daftar tugas
    public function index(Request $request)
    {
        $tasks = Task::where('project_id', $request->project_id)
            ->where('assigned_to', $request->user_id)
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    // Menampilkan form untuk membuat tugas
    public function create(Request $request)
    {
        $projectId = $request->project_id;
        $userId = $request->user_id;  // Ambil user_id dari URL

        return view('tasks.create', [
            'projectId' => $projectId,
            'userId' => $userId,  // Kirimkan user_id ke view
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


    // Menampilkan form untuk submit tugas
    public function submit(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);

        if ($task->assigned_to != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('tasks.submit', compact('task'));
    }

    // Menyimpan submission file
    public function storeSubmission(Request $request, $taskId)
    {
        $request->validate([
            'submission_file' => 'required|file|mimes:pdf,doc,docx,zip|max:2048',
        ]);

        $task = Task::findOrFail($taskId);

        if ($task->assigned_to != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $filePath = $request->file('submission_file')->storeAs(
            'submissions',
            "task_{$taskId}_user_" . auth()->id() . '.' . $request->file('submission_file')->getClientOriginalExtension(),
            'public'
        );

        $task->update(['status' => 'done', 'submission_file' => $filePath]);

        return redirect()->route('tasks.index', ['project_id' => $task->project_id, 'user_id' => auth()->id()])
            ->with('success', 'Task submitted successfully!');
    }
}
