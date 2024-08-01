<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SectionRequest extends FormRequest
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
            'Name_Section_Ar' => [
                'required',
                'string',
                Rule::unique('sections', 'name_section->ar')
                    ->where(function ($query) {
                        return $query->where('Grade_id', $this->Grade_id)->where('Class_id', $this->Class_id);
                    })
                    ->ignore($this->id),
            ],
            'Name_Section_En' => [
                'required',
                'string',
                Rule::unique('sections', 'name_section->en')
                    ->where(function ($query) {
                        return $query->where('Grade_id', $this->Grade_id)->where('Class_id', $this->Class_id);
                    })
                    ->ignore($this->id),
            ],
            'Grade_id' => ['required', 'exists:grades,id'],
            'Class_id' => ['required', 'exists:classrooms,id'],
        ];
    }
}
