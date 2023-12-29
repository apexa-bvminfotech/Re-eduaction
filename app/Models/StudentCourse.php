<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    use HasFactory;

    protected $fillable = ['student_id','user_id','course_id','start_date','end_date','restart_date','appreciation_id','appreciation_given_date'];

    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function appreciation(){
        return $this->belongsTo(Appreciation::class);
    }
    public function courseWiseMaterial(){
        return $this->hasMany(CourseWiseMaterial::class,'course_id','course_id');
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function studentCourseMaterial(){
        return $this->belongsTo(StudentCourseMaterial::class,'student_id','student_id');
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}
