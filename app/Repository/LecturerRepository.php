<?php


namespace App\Repository;

use App\DTO\Request\CreateUserRequest;
use App\Models\Lecturer;
use Illuminate\Database\Connection;

class LecturerRepository extends BaseRepository
{
    /**
     * LecturerRepository constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
    }

    public function insertLecturer(CreateUserRequest $lecturerData, int $userId): int
    {
        $lecture = Lecturer::create([
            'FIRST_NAME' => $lecturerData->firstName,
            'LAST_NAME' => $lecturerData->lastName,
            'USER_ID' => $userId,
        ]);

        return $lecture->id;
    }

    public function getAll()
    {
        return Lecturer::all();
    }

    public function getLecturerByUserId(int $userId): Lecturer
    {
        $lecturer = Lecturer::where('USER_ID', $userId);

        return $lecturer->first();
    }

    public function getLecturerIdByUserId(int $userId): int
    {
        $lecturer = Lecturer::select('LECTURER_ID')->where('USER_ID', $userId);

        return $lecturer->first()->LECTURER_ID;
    }
}
