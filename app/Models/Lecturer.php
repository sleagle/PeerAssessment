<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'LECTURER';

    protected $fillable = [
        'LECTURER_ID',
        'FIRST_NAME',
        'LAST_NAME',
        'USER_ID',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function unit()
    {
        return $this->hasMany(Unit::class);
    }
}
