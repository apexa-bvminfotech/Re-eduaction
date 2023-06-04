<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rtc extends Model
{
    use HasFactory;
    protected $table="rtc";

    protected $fillable = [
        'rtc_name',
        'address',
        'rtc_no',
        'is_active'
    ];
}
