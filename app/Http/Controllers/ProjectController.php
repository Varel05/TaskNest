<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $projects = Project::with('user')->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:ongoing,completed',
        ]);

        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('group-members.create', $project->id);
    }

    public function show($id)
    {
        $project = Project::with(['groupMembers.user'])->findOrFail($id);

        return view('projects.show', compact('project'));
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index');
    }

    public function addMemberForm($id)
    {
        $project = Project::with('groupMembers')->findOrFail($id);
        $users = User::whereNotIn('id', $project->groupMembers->pluck('user_id'))->get();

        return view('projects.add-member', compact('project', 'users'));
    }

    public function storeMember(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $this->authorize('update', $project);

        foreach ($request->members as $memberName) {
            $user = User::where('name', $memberName)->first();

            if ($user) {
                GroupMember::create([
                    'project_id' => $project->id,
                    'user_id' => $user->id,
                    'role' => 'member',
                ]);
            }
        }

        return redirect()->route('projects.show', $project->id)
                        ->with('success', 'Members added successfully.');
    }
}