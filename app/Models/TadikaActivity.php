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
}
