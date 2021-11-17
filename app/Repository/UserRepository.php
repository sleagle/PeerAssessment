<?php


namespace App\Repository;

use App\DTO\UserDTO;
use App\Exceptions\PeerAssessmentException;
use App\Models\User;
use Illuminate\Database\Connection;

class UserRepository extends BaseRepository
{
    /**
     * UserRepository constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
    }

    /**
     * @param string $username
     * @return User
     * @throws PeerAssessmentException
     */
    public function getUserByUsername(string $username): User
    {
        $user =  User::where('USERNAME', $username);

        if ($user->exists()) {
            return $user->first();
        }

        else {
            $passException = new PeerAssessmentException();
            $passException->setCode("ERR001");
            $passException->setMessage("Invalid login details");

            throw $passException;
        }
    }

    public function createUser(UserDTO $userData): int
    {
        $user = User::create([
            'USERNAME' => $userData->getUsername(),
            'PASSWORD' => $userData->getPassword(),
            'USER_TYPE_ID' => $userData->getUserType(),
        ]);

        return $user->id;
    }
}
