<?php

namespace App\Http\Requests;

use App\Rules\StudentAttendanceRule;
use App\Rules\StudentInTrainerClass;
use Illuminate\Foundation\Http\FormRequest;

class StudentAttendanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'data.*.student_id' => [
                'required',
                new StudentAttendanceRule(auth()->id(),$this->attendance_date,$this->data),
            ],
            'attendance_date' => 'required|unique:students_attendance,attendance_date',
        ];
    }

    public function messages()
    {

        return [
            'student_id' => 'student has already present',
            'attendance_date' =>'date has already taken',
        ];

    }
}
