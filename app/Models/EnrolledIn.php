<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrolledIn extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'ENROLLED_IN';

    protected $fillable = [
        'UNIT_CODE',
        'STUDENT_ID',
        'YEAR',
        'SEMESTER',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
