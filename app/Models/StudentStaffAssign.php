<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentStaffAssign extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function trainer()
    {
        return $this->belongsTo(Trainer::class)->where('is_active',0);
    }
    public function slot()
    {
        return $this->belongsTo(Slot::class)->where('is_active', 0);
    }
    public function studentStaff()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
