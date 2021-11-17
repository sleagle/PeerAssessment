<?php


namespace App\DTO\Request;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest
{
    /** @var string */
    public $username;

    /** @var string */
    public $password;
}
