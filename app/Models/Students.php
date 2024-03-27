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
        'parent_id',
        'is_active'
    ];

    public function applicationStatus(){
        return $this->hasOne(Application::class, 'student_id', 'id');
    }

    public function parents(){
        return $this->belongsTo(Parents::class, 'parent_id', 'user_id');
    }

}
