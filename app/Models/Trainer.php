<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function studentAssign()
    {
        return $this->hasMany(StudentStaffAssign::class);
    }
    public function studentAssignProxy()
    {
        return $this->hasMany(StudentProxyStaffAssign::class);
    }
    public function slots(){
        return $this->hasMany(Slot::class)->where('is_active', 0);
    }
    public function trainerAttendance(){
        return $this->hasMany(TrainerAttendance::class)->whereDate('date', now()->format('Y-m-d'));
    }
    public function trainerProxySlot(){
        return $this->hasMany(StudentProxyStaffAssign::class)->whereDate('starting_date', now()->format('Y-m-d'))->whereDate('ending_date', now()->format('Y-m-d'));
    }
    public function studentAttendance(){
        return $this->hasMany(StudentAttendance::class)->whereDate('attendance_date', now()->format('Y-m-d'));
    }
}
