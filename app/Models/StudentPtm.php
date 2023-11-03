<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPtm extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'student_ptm_report';

    public function trainer(){
        return $this->belongsTo(Trainer::class)->where('is_active',0);
    }
}
