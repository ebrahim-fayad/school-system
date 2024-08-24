<?php

namespace App\Http\Requests\Teacher\Quizzes;

use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
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
            'Name_ar' => ['required', 'string'],
            'Name_en' => ['required', 'string'],
            'subject_id' => ['required', 'integer', 'exists:subjects,id'],
            'teacher_id' => ['required', 'integer', 'exists:teachers,id'],
            'Grade_id' => ['required', 'integer', 'exists:grades,id'],
            'Classroom_id' => ['required', 'integer', 'exists:classrooms,id'],
            'section_id' => ['required', 'integer', 'exists:sections,id'],

        ];
    }
}
