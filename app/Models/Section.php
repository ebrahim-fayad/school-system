<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory,HasTranslations;
    public $translatable = ['Name_Section'];
    protected $guarded = ['id'];

    public function Grade()
    {
        return $this->belongsTo(Grade::class,'Grade_id');
    }
    public function Classroom()
    {
        return $this->belongsTo(Classroom::class,'Class_id');
    }
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_section_pivot');
    }
}
