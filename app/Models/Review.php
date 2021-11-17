<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'REVIEW';

    protected $fillable = [
        'REVIEW_ID',
        'SUBMISSION_ID',
        'REVIEWER_ID',
        'IS_COMPLETE',
        'FEEDBACK_MARK',
        'FEEDBACK_COMMENTS',
    ];

    public function submission()
    {
        $this->belongsTo(Submission::class);
    }

    public function review()
    {
        $this->belongsTo(Review::class);
    }
}
