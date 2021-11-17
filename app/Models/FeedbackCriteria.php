<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackCriteria extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'FEEDBACK_CRITERIA';

    protected $fillable = [
        'FEEDBACK_CRITERIA_ID',
        'CRITERIA_NAME',
        'CRITERIA_MARKS',
        'HD_CRITERIA_DESC',
        'DN_CRITERIA_DESC',
        'CR_CRITERIA_DESC',
        'PP_CRITERIA_DESC',
        'NN_CRITERIA_DESC',
        'ASSIGNMENT_ID',
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }
}
