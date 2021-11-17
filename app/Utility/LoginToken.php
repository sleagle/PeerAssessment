<?php


namespace App\Utility;


class LoginToken
{

    /**
     * @var string
     */
    public $userId;

    /**
     * @var string
     */
    public $userType;

    /**
     * @param LoginToken $loginToken
     * @return string - userId
     */
    public static function getUserId(LoginToken $loginToken)
    {
        return $loginToken->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @param LoginToken $loginToken
     * @return string - userType
     */
    public static function getUserType(LoginToken $loginToken)
    {
        return $loginToken->userType;
    }

    /**
     * @param mixed $userType
     */
    public function setUserType($userType): void
    {
        $this->userType = $userType;
    }

}