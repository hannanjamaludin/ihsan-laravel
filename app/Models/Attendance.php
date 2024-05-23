<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendance';
    protected $fillable = [
        'student_id',
        'class_id',
        'date',
        'status',
    ];

    public function student(){
        return $this->belongsTo(Students::class, 'student_id', 'id');
    }

    public function class(){
        return $this->belongsTo(TadikaClass::class, 'class_id', 'id');
    }
}
