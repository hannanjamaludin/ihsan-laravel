<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'ic_no',
        'dob',
        'gender',
        'siblings',
        'illness',
        'allergy',
        'study',
        'disability',
        'address1', 
        'postcode',
        'district',
        'state', 
        'branch_id',
        'dad_id',
        'mom_id',
        'user_id',
        'is_active'
    ];

    public function applicationStatus(){
        return $this->hasOne(Application::class, 'student_id', 'id');
    }

    // public function user(){
    //     return $this->belongsTo(User::class, 'user_id', );
    // }

    public function mom(){
        return $this->hasOne(Parents::class, 'id', 'mom_id');
    }
    
    public function dad(){
        return $this->hasOne(Parents::class, 'id', 'dad_id');
    }

    public function branch(){
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }

}
