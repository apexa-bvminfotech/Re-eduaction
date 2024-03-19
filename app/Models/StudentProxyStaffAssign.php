<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProxyStaffAssign extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function trainer()
    {
        return $this->belongsTo(Trainer::class)->where('is_active',0);
    }
    public function regular()
    {
        return $this->belongsTo(Trainer::class,'old_regular_trainer_id');
    }
    public function slot()
    {
        return $this->belongsTo(Slot::class)->where('is_active', 0);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class)->where('is_active', 0);
    }

    public function studentcourses()
    {
        return $this->hasMany(StudentCourse::class, 'student_id', 'student_id');
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

}
