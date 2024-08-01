<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{
    use HasFactory,HasTranslations;
    public $translatable = ['Name'];
    protected $guarded = ['id'];

    public function Specialization()
    {
        return $this->belongsTo(Specialization::class, 'Specialization_id');
    }
    public function Gender()
    {
        return $this->belongsTo(Gender::class, 'Gender_id');
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'teacher_section_pivot');
    }
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

}
