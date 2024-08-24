<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Quizze extends Model
{
    use HasFactory,HasTranslations,HasUuids;
    protected $primaryKey = 'id';
    protected $translatable = ['name'];
    protected $guarded = ['id'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
    public function grade()
    {
        return $this->belongsTo(grade::class, 'grade_id');
    }
    public function classroom()
    {
        return $this->belongsTo(classroom::class, 'classroom_id');
    }
    public function section()
    {
        return $this->belongsTo(section::class, 'section_id');
    }
    public function subject()
    {
        return $this->belongsTo(subject::class, 'subject_id');
    }
}
