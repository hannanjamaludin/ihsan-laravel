<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TadikaActivityStudent extends Model
{
    use HasFactory;

    protected $table = 'tadika_activity_student';

    protected $fillable = [
        'student_id',
        'activity_id',
        'comment',
        'teacher_id',
    ];

    public function student(){
        return $this->hasOne(Students::class, 'id', 'student_id');
    }
}
