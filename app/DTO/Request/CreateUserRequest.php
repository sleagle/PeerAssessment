<?php


namespace App\DTO\Request;


class CreateUserRequest
{
    /** @var string */
    public $token;

    /** @var string */
    public $username;

    /** @var string */
    public $firstName;

    /** @var string */
    public $lastName;

    /** @var string */
    public $password;
}
