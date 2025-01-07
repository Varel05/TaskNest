<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'user_id', 'role'];

    // Relasi ke proyek
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Relasi ke pengguna
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}