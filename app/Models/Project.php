<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'created_by',
    ];

    // Relasi dengan User
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi untuk groupMembers
    public function groupMembers()
    {
        return $this->hasMany(GroupMember::class, 'project_id');
    }

    // Relasi dengan Task
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}