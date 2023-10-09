<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    public function subCourses(){
        return $this->hasMany(SubCourse::class);
    }
    public function studentCourse(){
        return $this->hasMany(StudentCourse::class);
    }
    public function courseMaterial(){
        return $this->hasMany(CourseWiseMaterial::class);
    }
}
