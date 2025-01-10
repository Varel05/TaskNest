<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index($taskId)
    {
        $task = Task::with('comments.user')->findOrFail($taskId);

        if (GroupMember::where('project_id', $task->project_id)
            ->where('user_id', auth()->id())
            ->where('role', 'leader')->doesntExist()) {
            abort(403, 'Unauthorized action.');
        }

        return view('comments.index', compact('task'));
    }

    public function store(Request $request, $taskId)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        // Menyimpan komentar
        Comment::create([
            'task_id' => $taskId,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return redirect()->route('tasks.show', $taskId)
            ->with('success', 'Comment added successfully!');
    }
}
