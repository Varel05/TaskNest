<?php

namespace App\Http\Controllers;

use App\Models\GroupMember;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class GroupMemberController extends Controller
{
    public function create(Project $project)
    {
        // Periksa apakah data ketua sudah tersimpan
        $leaderExists = GroupMember::where('project_id', $project->id)
            ->where('role', 'leader')
            ->exists();

        // Simpan data ketua jika belum ada
        if (!$leaderExists) {
            GroupMember::create([
                'project_id' => $project->id,
                'user_id' => auth()->id(),
                'role' => 'leader',
            ]);
        }

        // Ambil daftar pengguna untuk form anggota
        $users = User::where('id', '!=', auth()->id())->get(); // Kecualikan ketua
        return view('group_members.create', compact('project', 'users'));
    }

    public function store(Request $request, Project $project)
    {
        // Validasi input
        $request->validate([
            'members.*.user_id' => 'required|exists:users,id',
            'members.*.role' => 'required|in:member',
        ]);

        // Tambahkan anggota lainnya
        foreach ($request->members as $member) {
            GroupMember::create([
                'project_id' => $project->id,
                'user_id' => $member['user_id'],
                'role' => $member['role'],
            ]);
        }

        return redirect()->route('projects.index')->with('success', 'Group members added successfully!');
    }

    public function kick($memberId)
    {
        $member = GroupMember::findOrFail($memberId);
        
        // Pastikan hanya ketua yang bisa menghapus anggota
        if(Auth::user()->role != 'ketua') {
            return redirect()->back()->with('error', 'Hanya ketua yang bisa menghapus anggota.');
        }

        $member->delete();
        return redirect()->route('project.show', $member->project_id)->with('success', 'Anggota berhasil dihapus.');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}