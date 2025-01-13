<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\GroupMember;

class GroupMemberController extends Controller
{
    public function create(Request $request)
    {
        $projectId = $request->project_id;
    
        return view('group_members.create', [
            'users' => User::where('id', '!=', auth()->id())->get(),
            'projectId' => $projectId,
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);
    
        foreach ($request->user_ids as $userId) {
            GroupMember::firstOrCreate([
                'project_id' => $request->project_id,
                'user_id' => $userId,
            ], [
                'role' => 'member',
            ]);
        }
    
        // Tambahkan user yang login sebagai leader
        GroupMember::firstOrCreate([
            'project_id' => $request->project_id,
            'user_id' => auth()->id(),
        ], [
            'role' => 'leader',
        ]);
    
        return redirect()->route('projects.show', $request->project_id)->with('success', 'Members added successfully!');
    }

    public function addMemberForm($projectId)
    {
        $project = Project::findOrFail($projectId);

        if (!GroupMember::where('project_id', $projectId)
            ->where('user_id', auth()->id())
            ->where('role', 'leader')->exists()) {
            abort(403, 'Unauthorized action.');
        }

        $users = User::whereNotIn('id', function ($query) use ($projectId) {
            $query->select('user_id')
                ->from('group_members')
                ->where('project_id', $projectId);
        })->get();

        return view('projects.add_member', compact('project', 'users'));
    }

    public function storeMember(Request $request, $projectId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:member',
        ]);

        $project = Project::findOrFail($projectId);

        if (!GroupMember::where('project_id', $projectId)
            ->where('user_id', auth()->id())
            ->where('role', 'leader')->exists()) {
            abort(403, 'Unauthorized action.');
        }

        $existingMember = GroupMember::where('project_id', $projectId)
            ->where('user_id', $request->user_id)
            ->first();

        if ($existingMember) {
            return redirect()->back()->withErrors('This user is already a member of the project.');
        }

        GroupMember::create([
            'project_id' => $projectId,
            'user_id' => $request->user_id,
            'role' => $request->role,
        ]);

        return redirect()->route('projects.show', $projectId)->with('success', 'Member added successfully!');
    }

public function removeMember($projectId, $userId)
{
    $member = GroupMember::where('project_id', $projectId)
        ->where('user_id', $userId)
        ->where('role', 'member')
        ->firstOrFail();

    if (!GroupMember::where('project_id', $projectId)
        ->where('user_id', auth()->id())
        ->where('role', 'leader')->exists()) {
        abort(403, 'Unauthorized action.');
    }

    $member->delete();

    return redirect()->route('projects.show', $projectId)->with('success', 'Member removed successfully!');
}

}
