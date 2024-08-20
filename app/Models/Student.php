<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    use HasFactory,HasTranslations ,SoftDeletes;
    public $translatable = ['name'];
    protected $guarded = ['id'];

    public function Nationality()
    {
        return $this->belongsTo(Nationality::class,'nationality_id');
    }
    public function Gender()
    {
        return $this->belongsTo(Gender::class,'gender_id');
    }
    public function Grade()
    {
        return $this->belongsTo(Grade::class,'Grade_id');
    }
    public function Section()
    {
        return $this->belongsTo(Section::class);
    }
    public function Classroom()
    {
        return $this->belongsTo(Classroom::class,'Classroom_id');
    }
    public function parent()
    {
        return $this->belongsTo(MyParent::class);
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function student_account()
    {
        return $this->hasMany(StudentAccount::class,'student_id');
    }
}
