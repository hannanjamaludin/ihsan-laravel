<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskaActivityStudent extends Model
{
    use HasFactory;

    protected $table = 'taska_activity_student';

    protected $fillable = [
        'activity_id',
        'student_id',
        'path',
        'type',
    ];
}
