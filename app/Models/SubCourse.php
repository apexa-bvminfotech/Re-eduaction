<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCourse extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    public function points(){
        return $this->hasMany(SubCoursePoint::class);
    }
}
