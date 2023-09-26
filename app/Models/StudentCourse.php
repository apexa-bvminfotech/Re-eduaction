<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    use HasFactory;

    protected $fillable = ['student_id','user_id','course_id','start_date','end_date','appreciation_id','appreciation_given_date'];

    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function appreciation(){
        return $this->belongsTo(Appreciation::class);
    }
}
