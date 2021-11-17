<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'USER';

    protected $fillable = [
        'USER_ID',
        'USERNAME',
        'PASSWORD',
        'USER_TYPE_ID',
    ];

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }
}
