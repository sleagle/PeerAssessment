<?php


namespace App\Repository;


use App\DTO\CreateStudentDTO;
use App\Models\Student;
use Illuminate\Database\Connection;

class StudentRepository extends BaseRepository
{
    /**
     * StudentRepository constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
    }

    /**
     * @param int $studentId
     * @return bool if student exists or not
     */
    public function checkIfStudentExists(int $studentId): bool
    {
        $student = Student::where('STUDENT_ID', $studentId);

        if ($student->exists())
        {
            return true;
        }

        else {
            return false;
        }
    }

    /**
     * @param int $userId
     * @return Student
     */
    public function getStudentByUserId(int $userId): Student
    {
        $student = Student::where('USER_ID', $userId);

        return $student->first();
    }

    /**
     * @param CreateStudentDTO $data
     * @param $userId
     * @return int
     */
    public function createStudent(CreateStudentDTO $data, $userId): int
    {
        $student = Student::create([
            'STUDENT_ID' => $data->studentId,
            'FIRST_NAME' => $data->firstName,
            'LAST_NAME' => $data->lastName,
            'IS_ENABLED' => true,
            'USER_ID' => $userId,
        ]);

        return $student->id;
    }
}
