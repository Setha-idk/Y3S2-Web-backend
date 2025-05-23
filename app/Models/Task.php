<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'due_date',
        'file_path'
    ];

    protected $casts = [
        'due_date' => 'date'
    ];

    public function steps()
    {
        return $this->hasMany(Step::class);
    }
}
