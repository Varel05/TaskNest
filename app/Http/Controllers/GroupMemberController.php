<?php

namespace App\Http\Controllers;

use App\Models\GroupMember;
use Illuminate\Http\Request;

class GroupMemberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:leader,member',
        ]);

        GroupMember::create([
            'project_id' => $request->project_id,
            'user_id' => $request->user_id,
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'Anggota berhasil ditambahkan.');
    }
}
