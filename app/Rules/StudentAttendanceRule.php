<?php

namespace App\Rules;

use App\Models\Student;
use Illuminate\Contracts\Validation\Rule;

class StudentAttendanceRule implements Rule
{
    protected $userId;
    protected $attendance_date;

    public function __construct($userId,$attendance_date,$attendanceData)
    {
        $this->userId = $userId;
        $this->attendance_date = $attendance_date;
        $this->attendanceData = $attendanceData;
    }

    public function passes($attribute, $value)
    {
//        dd($attribute,$value);
        $studentIds = is_array($value) ? $value : [$value];

        foreach ($studentIds as $studentId) {
//            dd($studentId);
            $student = Student::find($studentId);
            if (!$student) {
                return false;
            }

            $existingAttendance = $student->attendance()
                ->where('attendance_date',$this->attendance_date)
                ->where('user_id', '!=', $this->userId)
                ->first();

            if ($existingAttendance) {
                if ($existingAttendance['attendance_type'] === 0 && $this->isPresent($studentId)) {
                    return false;
                }
            }
        }

        return true;
    }

    public function message()
    {
        return 'The student is already present for another user and cannot be marked as present in this attendance.';
    }

    private function isPresent($studentId)
    {
        return collect($this->attendanceData)
                ->where('student_id', $studentId)
                ->where('attendance_type', 0)
                ->first();
    }
}
