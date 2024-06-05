<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'ic_no',
        'email',
        'phone_no',
        'job',
        'role_id',
        'staff_no',
        'student_no',
        'address',
        'district',
        'state',
        'postcode'
    ];

    // public function state(){
    //     return $this->belongsTo(State::class, 'state', 'id');
    // }
    
    // public function district(){
    //     return $this->belongsTo(District::class, 'district', 'id');
    // }
}
