<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseWiseMaterial extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table ="course_wise_materials";

    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function studentCourseMaterial(){
        return $this->belongsTo(StudentCourseMaterial::class,'id','course_material_id');
    }
}
