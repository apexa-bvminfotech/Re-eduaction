<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table="staff";

    protected $fillable = [
        'staff_name',
        'staff_phone',
        'course_id',
        'employee_ID',
        'staff_I_card',
        'staff_uniform',
        'staff_address',
        'eme_phone',
        'user_id'
    ];
}
