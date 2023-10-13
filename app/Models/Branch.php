<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    use HasFactory;
    protected $guarded=[
        'id'
    ];

    public function trainer(){
        return $this->hasMany(Trainer::class);
    }
    public function student(){
        return $this->hasMany(Student::class);
    }
}
