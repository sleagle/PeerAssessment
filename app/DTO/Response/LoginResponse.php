<?php


namespace App\DTO\Response;


class LoginResponse
{
    /** @var string */
    public $userName;

    /** @var string */
    public $userType;

    /** @var string */
    public $token;

    /**
     * LoginResponse constructor.
     * @param string $userName
     * @param string $userType
     * @param string $token
     */
    public function __construct(string $userName, string $userType, string $token)
    {
        $this->userName = $userName;
        $this->userType = $userType;
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getUserType(): string
    {
        return $this->userType;
    }

    /**
     * @param string $userType
     */
    public function setUserType(string $userType): void
    {
        $this->userType = $userType;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }
}
