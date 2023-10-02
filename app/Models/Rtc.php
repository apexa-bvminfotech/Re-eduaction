<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rtc extends Model
{
    use HasFactory;
    protected $table ="rtc";
    protected $fillable = [
        'rtc_name',
        'branch_id',
        'person_name',
        'contact',
        'address',
        'rtc_no',
        'is_active'
    ];
    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id','id');
    }
}
