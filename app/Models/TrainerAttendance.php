<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainerAttendance extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function slots()
    {
        return $this->belongsTo(Slot::class,'slot_id','id');
    }
}









