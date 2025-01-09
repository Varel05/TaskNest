<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'user_id', 'file_path'];

    // Relasi ke Task
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // Relasi ke User (yang mengirimkan submission)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
