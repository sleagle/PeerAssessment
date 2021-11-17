<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'CRITERIA';

    protected $fillable = [
        'CRITERIA_ID',
        'CRITERIA_NAME',
        'CRITERIA_MARKS',
        'HD_CRITERIA_DESC',
        'DN_CRITERIA_DESC',
        'CR_CRITERIA_DESC',
        'PP_CRITERIA_DESC',
        'NN_CRITERIA_DESC',
        'ASSIGNMENT_ID',
        'CONTAIN_SUB_CATEGORY',
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function subCriterias()
    {
        return $this->hasMany(SubCriteria::class);
    }

    public function criteriaReviews()
    {
        return $this->hasMany(CriteriaReview::class);
    }
}
