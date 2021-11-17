<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'SUBMISSION';

    protected $fillable = [
        'SUBMISSION_ID',
        'STUDENT_ID',
        'ASSIGNMENT_ID',
        'SUBMISSION_DATE',
        'FILE',
        'NUM_REVIEWS'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
