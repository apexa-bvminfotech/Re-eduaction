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
        return $this->hasMany(Slot::class);
    }

}
