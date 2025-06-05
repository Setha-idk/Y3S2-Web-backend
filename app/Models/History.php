<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';

    protected $fillable = [
        'action_time',
        'user_name',
        'email',
        'name',
        'employee_id',
        'action',
        'description',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
