<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'STUDENT';

    protected $fillable = [
        'STUDENT_ID',
        'FIRST_NAME',
        'LAST_NAME',
        'IS_ENABLED',
        'USER_ID',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function enrolledIns()
    {
        return $this->hasMany(EnrolledIn::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function studentTopics()
    {
        return $this->hasMany(StudentTopic::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
