<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sloat extends Model
{
    use HasFactory;
    protected $table="sloat";

    protected $fillable = [
        'sloat_time',
        'staff_id',
        'rtc_id',
        'is_active'
    ];

    public function rtc(){
        return $this->belongsTo(Rtc::class);
    }
}
