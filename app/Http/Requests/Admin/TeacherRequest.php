<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        // $teacherId = $this->route('teacher'); // Adjust if the route parameter name is different

        return [
            'Email' => ['required', 'email', "unique:teachers,Email,$this->teacher"],
            'Password' => 'required|sometimes',
            'Name_ar' => 'required',
            'Name_en' => 'required',
            'Specialization_id' => 'required',
            'Gender_id' => 'required',
            'Joining_Date' => 'required|date|date_format:Y-m-d',
            'Address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'Email.required' => trans('validation.required'),
            'Email.unique' => trans('validation.unique'),
            'Password.required' => trans('validation.required'),
            'Name_ar.required' => trans('validation.required'),
            'Name_en.required' => trans('validation.required'),
            'Specialization_id.required' => trans('validation.required'),
            'Gender_id.required' => trans('validation.required'),
            'Joining_Date.required' => trans('validation.required'),
            'Address.required' => trans('validation.required'),
        ];
    }
}
