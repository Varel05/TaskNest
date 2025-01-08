<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index($project_id, $user_id)
    {
        // Ambil data tugas berdasarkan project_id dan user_id
        $tasks = Task::where('project_id', $project_id)
                     ->where('assigned_to', $user_id)
                     ->get();
    
        return view('tasks.index', compact('tasks', 'project_id', 'user_id'));
    }

    public function tasksByUser($project_id, $user_id)
    {
        $project = Project::findOrFail($project_id);
        $tasks = Task::where('project_id', $project_id)
                    ->where('assigned_to', $user_id)
                    ->get();

        $user = User::findOrFail($user_id);
        $isLeader = $project->groupMembers()->where('user_id', Auth::id())->where('role', 'leader')->exists();

        return view('tasks.user', compact('project', 'tasks', 'user', 'isLeader'));
    }

    public function tasksByProject($projectId)
    {
        // Cari proyek dan relasi anggota kelompok
        $project = Project::with('groupMembers.user')->findOrFail($projectId);

        // Ambil semua anggota
        $members = $project->groupMembers;

        // Ambil task berdasarkan anggota kelompok
        $tasks = [];
        foreach ($members as $member) {
            $memberTasks = $member->user->tasks()->where('project_id', $projectId)->get();
            $tasks[$member->user->id] = [
                'user' => $member->user,
                'tasks' => $memberTasks,
            ];
        }

        return view('tasks.by_project', compact('project', 'tasks'));
    }

    public function create($project_id)
    {
        return view('tasks.create', compact('project_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'assigned_to' => 'required',
            'due_date' => 'required|date',
            'status' => 'required',
            'priority' => 'required',
        ]);

        Task::create([
            'project_id' => $request->project_id,
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'priority' => $request->priority,
        ]);

        return redirect()->route('tasks.index', ['project_id' => $request->project_id, 'user_id' => $request->assigned_to]);
    }

    public function show($userId)
    {
        $tasks = Task::where('assigned_to', $userId)->get();
        return view('tasks.show', compact('tasks'));
    }

}