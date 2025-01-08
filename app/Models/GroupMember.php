<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;

    protected $table = 'group_members';

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'project_id',
        'user_id',
        'role',
    ];

    // Relasi ke model Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
