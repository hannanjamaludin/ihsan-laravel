<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskaActivity extends Model
{
    use HasFactory;

    protected $table = 'taska_activity';

    protected $fillable = [
        'room_id',
        'teacher_id',
        'activity', 
        'date',
        'type',
        'path',
    ];

    public function activityStudent(){
        return $this->hasMany(TaskaActivityStudent::class, 'activity_id', 'id');
    }
}
