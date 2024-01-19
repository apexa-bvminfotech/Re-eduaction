<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentStatus extends Model
{
    use HasFactory;
    protected $table = 'student_status';
    protected $guarded = ['id'];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function studentcourses()
    {
        return $this->hasMany(StudentCourse::class, 'student_id', 'student_id');
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
