<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'ASSIGNMENT';

    protected $fillable = [
        'ASSIGNMENT_ID',
        'YEAR',
        'SEMESTER',
        'TITLE',
        'OUTCOME',
        'SCENARIO',
        'TOPIC_SELECTION_DEADLINE',
        'ASSIGNMENT_SUBMISSION_DEADLINE',
        'ASSIGNMENT_SUBMISSION_CLOSING',
        'ASSIGNMENT_MARKING_OPENING_DATE',
        'ASSIGNMENT_MARKING_DEADLINE',
        'FEEDBACK_MARKING_OPENING_DATE',
        'FEEDBACK_MARKING_DEADLINE',
        'NO_OF_REVIEWS',
        'ALLOCATION_CRITERIA',
        'UNIT_CODE'
    ];

    public function unit() {
        return $this->belongsTo(Unit::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function criterias()
    {
        return $this->hasMany(Criteria::class);
    }

    public function feedbackCriterias()
    {
        return $this->hasMany(FeedbackCriteria::class);
    }

    public function enrolledIns()
    {
        return $this->hasMany(EnrolledIn::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
