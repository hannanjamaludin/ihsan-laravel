<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TadikaActivity extends Model
{
    use HasFactory;

    protected $table = 'tadika_activity';
    protected $fillable = [
        'class_id',
        'teacher_id',
        'subject_id',
        'learning',
        'activity',
        'date'
    ];

    public function subjects(){
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }

    public function studentActivity(){
        return $this->hasMany(TadikaActivityStudent::class, 'activity_id', 'id');
    }

    public function attendance() {
        return $this->hasMany(Attendance::class, 'date', 'date');
    }
}
