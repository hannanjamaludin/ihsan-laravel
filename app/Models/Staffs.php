<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staffs extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'phone_no',
        'staff_no',
    ];

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function assignedClass(){
        return $this->belongsTo(TadikaClass::class, 'class_room', 'id');
    }
}
