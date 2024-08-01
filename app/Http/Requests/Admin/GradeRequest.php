<?php

namespace App\Http\Requests\Admin;

use App\Models\Grade;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GradeRequest extends FormRequest
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

    public function rules(): array
    {
        $isUpdate = $this->isMethod('post');
        return [
            // 'name' => array_filter([
            //     'required',
            //     $isUpdate ? Rule::unique('grades', 'name->ar')->ignore($this->id) : '',
            // ]),
            // 'name_en' => array_filter([
            //     'required',
            //     $isUpdate ? Rule::unique('grades', 'name->en')->ignore($this->id) : '',
            // ]),
            'name'=>['required', "unique:grades,name->ar,{$this->id}"],
            'name_en'=>['required', "unique:grades,name->en,{$this->id}"],
            'notes' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('Grades_trans.grade_name'),
            'name.unique' => trans('Grades_trans.exists'),
            'name_en.required' => trans('Grades_trans.grade_name_en'),
            'name_en.unique' => trans('Grades_trans.grade_name_en_exist'),
            'notes.required' => trans('Grades_trans.notes_required'),
        ];
    }
}
