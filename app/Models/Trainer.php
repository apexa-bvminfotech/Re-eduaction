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


}
