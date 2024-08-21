<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubjectRequest extends FormRequest
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
        return [
            'Name_ar' => [
                'required',
                'string',
                Rule::unique('subjects', 'name->ar')
                    ->where(function ($query) {
                        return $query->where('grade_id', $this->Grade_id)
                            ->where('classroom_id', $this->Classroom_id)
                            ->where('teacher_id', $this->teacher_id);
                    })
                    ->ignore($this->subject), // تأكد من أنك تستخدم معرف السجل هنا
            ],
            'Name_en' => [
                'required',
                'string',
                Rule::unique('subjects', 'name->en')
                    ->where(function ($query) {
                        return $query->where('grade_id', $this->Grade_id)
                            ->where('classroom_id', $this->Classroom_id)
                            ->where('teacher_id', $this->teacher_id);
                    })
                    ->ignore($this->subject), // تأكد من أنك تستخدم معرف السجل هنا
            ],
            'Grade_id' => ['required', 'exists:grades,id'],
            'Classroom_id' => ['required', 'exists:classrooms,id'],
            'teacher_id' => ['required', 'exists:teachers,id'],
        ];
    }
}
