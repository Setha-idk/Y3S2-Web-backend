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
        'status',
        'order',
        'task_id'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
