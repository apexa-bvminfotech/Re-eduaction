<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded=[
       'id'
    ];
    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function trainer(){
        return $this->belongsTo(Trainer::class,'analysis_trainer_id');
    }

    public function attendance()
    {
        return $this->hasMany(StudentAttendance::class);
    }
    public function studentAssign()
    {
        return $this->hasOne(StudentStaffAssign::class);
    }
}
