<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'USER_TYPE';

    protected $primaryKey = 'USER_TYPE_ID';

    protected $fillable = [
        'USER_TYPE_ID',
        'USER_TYPE',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
