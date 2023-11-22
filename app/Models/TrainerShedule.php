<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainerShedule extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','trainer_id','slot_id','date','note'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function trainer()
    {
        return $this->belongsTo(Trainer::class)->where('is_active',0);
    }
    public function slot()
    {
        return $this->belongsTo(Slot::class)->where('is_active', 0);
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
