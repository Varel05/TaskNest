<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Auth;

class ProjectController extends Controller
{
    // Menampilkan daftar project
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    // Form untuk membuat project baru
    public function create()
    {
        return view('projects.create');
    }

    // Menyimpan project baru
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:ongoing,completed',
        ]);

        Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Project created successfully.');
    }

    // Menampilkan detail project
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    // Form untuk edit project
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    // Update project
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:ongoing,completed',
        ]);

        $project->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Project updated successfully.');
    }

    // Hapus project
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('dashboard')->with('success', 'Project deleted successfully.');
    }
}