<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appreciation extends Model
{
    use HasFactory;
    protected $table = "appreciation";
    protected $guarded=[
        'id'
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
