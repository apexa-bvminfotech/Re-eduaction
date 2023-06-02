<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCoursePoint extends Model
{
    use HasFactory;

    public $guarded = ['id'];
    public function subCourse(){
        return $this->belongsTo(SubCourse::class,'sub_point_name','id');
    }
}
