<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Proyek di mana user adalah ketua tim
        $projectsAsLeader = $user->projectsAsLeader;

        // Proyek di mana user adalah anggota (role: member)
        $projectsAsMember = $user->projectsAsMember()->wherePivot('role', 'member')->get();

        // Gabungkan proyek dan hilangkan duplikat
        $projects = $projectsAsLeader->merge($projectsAsMember)->unique('id');

        return view('dashboard', compact('projects'));
    }
}