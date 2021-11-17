<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'UNIT';

    protected $fillable = [
        'UNIT_CODE',
        'UNIT_NAME',
        'LECTURER_ID',
    ];

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function enrolledIns()
    {
        return $this->hasMany(EnrolledIn::class);
    }
}
