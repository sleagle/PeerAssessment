<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriteriaReview extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'CRITERIA_REVIEW';

    protected $fillable = [
        'CRITERIA_ID',
        'REVIEW_ID',
        'MARK',
        'COMMENT',
        'GRADE',
    ];

    public function criteria() {
        $this->belongsTo(Criteria::class);
    }

    public function review() {
        $this->belongsTo(Review::class);
    }
}
