<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table="staff";

    protected $fillable = [
        'first_name',
        'staff_name',
        'father_name',
        'staff_phone',
        'course_id',
        'employee_ID',
        'staff_I_card',
        'staff_uniform',
        'staff_address',
        'eme_phone',
        'user_id',
        'is_active'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
