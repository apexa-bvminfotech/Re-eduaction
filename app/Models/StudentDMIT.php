<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDMIT extends Model
{
    use HasFactory;
    protected $table = 'student_dmit';
    protected $guarded = ['id'];

    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function trainer(){
        return $this->belongsTo(Trainer::class,'counselling_by_trainer_name','id');
    }
}
