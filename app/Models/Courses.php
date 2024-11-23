<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courses extends Model
{
    use HasFactory;
    protected $primaryKey = 'course_id';
    use SoftDeletes;

    public $timestamps = false;
    protected $fillable = [
        'course_title',
        'course_description',
        'course_image',
        'course_price',
        'course_duration',
        'difficulty_leve',
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollments::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'user_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
