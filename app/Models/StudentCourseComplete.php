<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourseComplete extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function trainer(){
        return $this->belongsTo(Trainer::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function subCourses()
    {
        return $this->belongsToMany(SubCourse::class);
    }
}
