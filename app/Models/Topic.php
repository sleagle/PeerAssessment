<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'TOPIC';

    protected $fillable = [
        'TOPIC_ID',
        'TOPIC_NAME',
        'NUM_OF_STUDENTS',
        'NUM_SELECTED',
        'ASSIGNMENT_ID'
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function studentTopics()
    {
        return $this->hasMany(StudentTopic::class);
    }
}
