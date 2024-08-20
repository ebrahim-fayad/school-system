<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FeesRequest extends FormRequest
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
        return [
            'title_ar' => 'required',
            'title_en' => 'required',
            'amount' => 'required|numeric',
            'Grade_id' => 'required|integer|exists:grades,id',
            'Classroom_id' => ['required','integer','exists:classrooms,id'],
            'year' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title_ar.required' => trans('validation.required'),
            'title_en.required' => trans('validation.unique'),
            'Password.required' => trans('validation.required'),
            'amount.required' => trans('validation.required'),
            'amount.numeric' => trans('validation.numeric'),
            'Grade_id.required' => trans('validation.required'),
            'Classroom_id.required' => trans('validation.required'),
            'year.required' => trans('validation.required'),
        ];
    }
}
