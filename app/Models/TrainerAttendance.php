<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainerAttendance extends Model
{
    use HasFactory;
    protected $table="trainer_attendance";

    protected $fillable = [
        'trainers_id',
        'attendance',
        'absent_reason',
        'date',
        'user_id'
    ];
}
