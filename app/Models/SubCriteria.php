<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCriteria extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'SUB_CRITERIA';

    protected $fillable = [
        'SUB_CRITERIA_ID',
        'SUB_CRITERIA_TYPE',
        'SUB_CRITERIA_DESC',
        'SUB_CRITERIA_MARKS',
        'CRITERIA_ID',
    ];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
}
