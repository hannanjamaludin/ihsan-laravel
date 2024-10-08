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
        'ic_no',
        'phone_no',
        'staff_no',
        'branch_id',
        'class_room',
        'is_admin'
    ];

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function assignedClass(){
        return $this->belongsTo(TadikaClass::class, 'class_room', 'id');
    }
}
