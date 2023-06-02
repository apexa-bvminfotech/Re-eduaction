<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staffAttendance extends Model
{
    use HasFactory;
    protected $table="staff_attendance";

    protected $fillable = [
        'staff_id',
        'attendance',
        'absent_reason',
        'date',
        'user_id'
    ];
}
