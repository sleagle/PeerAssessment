<?php


namespace App\DTO\Response;


class UserResponse implements \JsonSerializable
{

    private $userId;

    private $userType;

    /**
     * UserResponseDTO constructor.
     * @param $userId
     * @param $userType
     */
    public function __construct($userId, $userType)
    {
        $this->userId = $userId;
        $this->userType = $userType;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
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
    public function setUserType($userType)
    {
        $this->userType = $userType;
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'userId' => $this->getUserId(),
            'userType' => $this->getUserType(),
        ];
    }
}
