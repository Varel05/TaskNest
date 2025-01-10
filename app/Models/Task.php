<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'assigned_to',
        'due_date',
        'status',
        'priority',
        'submission_file', // untuk file submission
    ];

    // Relasi ke Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Relasi ke User (assigned_to)
    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Relasi ke Submission (jika ada)
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
    // Relasi ke comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
