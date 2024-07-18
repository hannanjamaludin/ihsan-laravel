<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'staff_no',
        'last_login_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function staffs(){
        return $this->hasOne(Staffs::class, 'user_id', 'id');
    }

    public function parents(){
        return $this->hasOne(Parents::class, 'user_id', 'id');
    }

    public function isAdmin()
    {
        return $this->user_type === 1;
    }

    public function children(){
        return $this->hasMany(Students::class, 'user_id', 'id');
    }

    public function scopeActiveUsers($query, $days = 30){
        return $query->where('last_login_at', '>=', now()->subDays($days));
    }

}
