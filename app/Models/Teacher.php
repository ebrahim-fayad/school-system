<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Translatable\HasTranslations;

class Teacher extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasTranslations;
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
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

}
