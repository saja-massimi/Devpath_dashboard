<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    // Specify the primary key column name
    protected $primaryKey = 'teacher_id';

    // Optional: Specify if the primary key is not an incrementing integer
    public $incrementing = true;

    // Optional: Specify the primary key type if not 'int'
    protected $keyType = 'int';


    protected $fillable = [
        'name',
        'email',
        'phone',

    ];
}
