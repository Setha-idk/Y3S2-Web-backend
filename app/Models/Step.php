<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'task_id'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function assignments()
    {
        return $this->hasMany(TaskAssignment::class);
    }

    public function taskAssignments()
    {
        return $this->hasMany(TaskAssignment::class);
    }
}
