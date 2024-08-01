<?php

namespace App\Http\Requests\Admin;

use App\Models\Classroom;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class ClassroomRequest extends FormRequest
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
        $rules = [];
        $locale = App::getLocale();
        foreach ($this->input('List_Classes') as $key => $value) {
            $rules["List_Classes.$key.Name"] = [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($locale, $key) {
                    $existingClassroom = Classroom::where("Name_Class->{$locale}", $value)
                        ->where('grade_id', $this->input("List_Classes.$key.Grade_id"))
                        ->first();
                    if ($existingClassroom) {
                        $fail("اسم الصف \"{$value}\" موجود بالفعل في هذه المرحلة.");
                    }
                }
            ];
            $rules["List_Classes.$key.Name_class_en"] = ['required', 'string', 'max:255'];
            $rules["List_Classes.$key.Grade_id"] = ['required', 'exists:grades,id'];
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'List_Classes.*.Name.required' => trans('My_Classes_trans.name_r'),
            'List_Classes.*.Name_class_en.required' => trans('My_Classes_trans.name_en_r'),
            'List_Classes.*.Grade_id.required' => trans('My_Classes_trans.class_grade'),
            'List_Classes.*.Grade_id.exists' => trans('My_Classes_trans.class_grade_ex'),
        ];
    }
}
