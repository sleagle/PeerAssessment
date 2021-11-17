<?php


namespace App\DTO;


use App\Exception\PeerAssessmentException;
use App\Utility\Encryption;

final class UserDTO implements \JsonSerializable
{

    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /** @var int */
    private $userType;

    /**
     * UserDTO constructor.
     * @param string $username
     * @param string $password
     * @param int $userType
     * @throws PeerAssessmentException
     */
    public function __construct(string $username, string $password, int $userType)
    {
        $this->username = $username;
        $this->password = Encryption::EncryptUserPassword($password);
        $this->userType = $userType;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUserType()
    {
        return $this->userType;
    }

    /**
     * @param mixed $userType
     */
    public function setUserType($userType): void
    {
        $this->userType = $userType;
    }

    /**
     * @return string
     */
    public function getUserTypeString(): string
    {
        switch ($this->userType)
        {
            case 1:
                return "Admin";

            case 2:
                return "Lecturer";

            case 3:
                return "student";
        }
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
            'userType' => $this->getUserTypeString(),
        ];
    }
}
