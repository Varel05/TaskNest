<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'start_date', 'end_date', 'status', 'created_by'];

    // Relasi ke anggota proyek
    public function groupMembers()
    {
        return $this->hasMany(GroupMember::class);
    }

    // Relasi ke ketua proyek
    public function leader()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
