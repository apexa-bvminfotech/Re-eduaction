<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'slot_time',
        'trainer_id',
        'branch_id',
        'whatsapp_group_name',
        'rtc_id',
        'is_active'
    ];

    public function rtc(){
        return $this->belongsTo(Rtc::class);
    }
    public function trainer(){
        return $this->belongsTo(Trainer::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function studentAssign(){
        return $this->hasOne(StudentStaffAssign::class);
    }
    public function slotList(){
        return $this->hasMany(StudentStaffAssign::class)->where('is_active','0');
    }
    public function proxySlotlist(){
        return $this->hasMany(StudentProxyStaffAssign::class);
    }
}
