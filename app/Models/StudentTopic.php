<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTopic extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'STUDENT_TOPIC';

    protected $fillable = [
        'TOPIC_ID',
        'STUDENT_ID',
    ];

    public function topic()
    {
        $this->belongsTo(Topic::class);
    }

    public function student()
    {
        $this->belongsTo(Student::class);
    }
}
