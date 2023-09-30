<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourseMaterial extends Model
{
    use HasFactory;

    protected $fillable = ['student_id','course_material_id'];

    public function material(){
        return $this->belongsTo(CourseWiseMaterial::class,'course_material_id','id');
    }
}
