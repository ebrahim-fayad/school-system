<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasFactory,HasTranslations;
    public $translatable = ['Name_Class'];
    protected $fillable = ['Name_Class', 'Grade_id'];

    public function Grade()
    {
        return $this->belongsTo(Grade::class,'Grade_id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}

