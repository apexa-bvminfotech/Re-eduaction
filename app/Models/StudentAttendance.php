<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;
    protected $table="students_attendance";
    protected $guarded = ['id'];

    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function studentAssign(){
        return $this->belongsTo(StudentStaffAssign::class);
    }
    public function trainer(){
        return $this->belongsTo(Trainer::class);
    }
    public function slot(){
        return $this->belongsTo(Slot::class,'slot_id','id');
    }
}
