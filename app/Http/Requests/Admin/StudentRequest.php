<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar' => 'required',
            'name_en' => 'required',
            'email' => "required|email|unique:students,email,{$this->student}",
            'password' => 'sometimes|required|string|min:6|max:10',
            'gender_id' => 'required|exists:genders,id',
            'nationality_id' => 'required|exists:nationalities,id',
            'blood_id' => 'required|exists:type_bloods,id',
            'Date_Birth' => 'required|date|date_format:Y-m-d',
            'Grade_id' => 'required|exists:grades,id',
            'Classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
            'parent_id' => 'required|exists:my_parents,id',
            'academic_year' => 'required',
            'photo' => 'bail',
        ];
    }
}
