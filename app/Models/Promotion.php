<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function f_grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function t_grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function f_classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
    public function t_classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
    public function f_section()
    {
        return $this->belongsTo(Section::class);
    }
    public function t_section()
    {
        return $this->belongsTo(Section::class);
    }
}
