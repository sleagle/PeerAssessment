<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'ADMIN';

    protected $fillable = [
        'ADMIN_ID',
        'FIRST_NAME',
        'LAST_NAME',
        'USER_ID',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
