<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripePayment extends Model
{
    use HasFactory;
    protected $table = 'payment_stripe';
    protected $guarded = ['id'];

    public function students(){
        return $this->belongsTo(Students::class, 'student_id', 'id');
    }
}
