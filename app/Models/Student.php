<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
    public function proxyStaffAssignments()
    {
        return $this->hasMany(StudentProxyStaffAssign::class, 'student_id');
    }
    public function assignedStaff()
    {
        return $this->hasOne(StudentStaffAssign::class, 'student_id', 'id');
    }
    public function isStaffAssigned()
    {
        return $this->assignedStaff()->exists();
    }
    public function courses(){
        return $this->hasMany(StudentCourse::class);
    }
    public function studentStatus()
    {
        return $this->hasMany(StudentStatus::class, 'student_id');
    }
    public function isActiveStatus()
    {
        return  $this->studentStatus()->select('status')->where('is_active', 0)->first();
    }
    public function studentDmit(){
        return $this->hasOne(StudentDMIT::class,'student_id');
    }
    public function studentTrainer(){
        return $this->hasOne(StudentStaffAssign::class)->where('is_active', 0);
    }
    public function statusStudent(){
        return $this->hasOne(StudentStatus::class, 'student_id');
    }
    public function studentMaterial(){
        return $this->hasMany(StudentCourseMaterial::class);
    }
}
