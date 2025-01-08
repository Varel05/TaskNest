<?php
namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    /**
     * Determine if the given project can be viewed by the user.
     */
    public function view(User $user, Project $project)
    {
        // Hanya ketua atau anggota proyek yang bisa melihat proyek
        return $project->groupMembers->contains('user_id', $user->id);
    }

    /**
     * Determine if the given project can be updated by the user.
     */
    public function update(User $user, Project $project)
    {
        // Hanya ketua proyek yang bisa mengedit
        $leader = $project->groupMembers->where('role', 'leader')->first();
        return $leader && $leader->user_id === $user->id;
    }

    /**
     * Determine if the given project can be deleted by the user.
     */
    public function delete(User $user, Project $project)
    {
        // Hanya ketua proyek yang bisa menghapus
        $leader = $project->groupMembers->where('role', 'leader')->first();
        return $leader && $leader->user_id === $user->id;
    }
}
