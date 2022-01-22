<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'user_id',
        'matricula',
        'validationResult',
    ];

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
