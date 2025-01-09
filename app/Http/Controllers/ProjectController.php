<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\GroupMember;

class ProjectController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Ambil semua proyek di mana user terlibat
        $projects = Project::whereHas('groupMembers', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        return view('dashboard', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'ongoing',
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('group-members.create', ['project_id' => $project->id]);
    }
    
    public function show($id)
    {
        $project = Project::findOrFail($id);
        $userRole = auth()->user()->role; // Ambil role user yang sedang login

        return view('projects.show', compact('project', 'userRole'));
    }

}
