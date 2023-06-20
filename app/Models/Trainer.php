<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;
    protected $table="trainers";
    protected $fillable = [
        'name',
        'branch_id',
    ];
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}
