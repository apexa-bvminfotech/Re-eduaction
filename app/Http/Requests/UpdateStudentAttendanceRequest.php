<?php

namespace App\Http\Requests;
use App\Rules\StudentAttendanceRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentAttendanceRequest extends FormRequest
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
                new StudentAttendanceRule(auth()->id(),$this->date,$this->data),
            ],
            'data.*.absent_reason' => 'required_if:data.*.attendance_type,absent',
            'attendance_date' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'data.*.student_id' => 'student has already present',
            'attendance_date' =>'Attendance date is required',
        ];
    }
}
