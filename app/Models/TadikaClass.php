<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TadikaClass extends Model
{
    use HasFactory;

    protected $table = 'class';
    protected $fillable = [
        'age',
        'class_name',
        'capacity',
        'total_students'
    ];

    public function teacher(){
        return $this->belongsTo(Staffs::class, 'id', 'class_room');
    }

    public function attendance(){
        return $this->hasMany(Attendance::class, 'class_id', 'id');
    }
}
