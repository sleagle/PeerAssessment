<?php


namespace App\Service;


use App\DTO\CreateStudentDTO;
use App\DTO\Request\AddStudentsToUnitRequest;
use App\DTO\Response\StudentEnrollmentResponse;
use App\DTO\UserDTO;
use App\Repository\StudentRepository;
use App\Repository\UnitRepository;
use App\Repository\UserRepository;
use App\Utility\CSVToArray;
use App\Utility\Utility;
use JsonMapper;
use JsonMapper_Exception;

class UserService
{
    /** @var StudentRepository  */
    private $studentRepository;

    /** @var UnitRepository  */
    private $unitRepository;

    /** @var UserRepository  */
    private $userRepository;

    /**
     * UserService constructor.
     * @param StudentRepository $studentRepository
     * @param UnitRepository $unitRepository
     * @param UserRepository $userRepository
     */
    public function __construct(StudentRepository $studentRepository, UnitRepository $unitRepository,
                                UserRepository $userRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->unitRepository = $unitRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param AddStudentsToUnitRequest $data
     * @return array
     * @throws JsonMapper_Exception
     */
    public function addStudentsToUnit(AddStudentsToUnitRequest $data)
    {
        $csvDataArray = json_encode(CSVToArray::readCSVToArray($data->fileLocation));
        $mapper = new JsonMapper();

        $createStudentsArray = $mapper->mapArray(json_decode($csvDataArray), array(), CreateStudentDTO::class);

        foreach ($createStudentsArray as $studentObj)
        {
           if (!$this->studentRepository->checkIfStudentExists($studentObj->studentId))
            {
                $userId = $this->userRepository->createUser(new UserDTO($studentObj->userName,
                    $studentObj->studentId, Utility::STUDENT_USER_TYPE));

                $this->studentRepository->createStudent($studentObj, $userId);
            }

            if (!$this->unitRepository->checkEnrollment($data->unitCode, $studentObj->studentId,
                Utility::getYear(), Utility::getSemester())) {

                $this->unitRepository->createEnrollment($data->unitCode, $studentObj->studentId,
                    Utility::getYear(), Utility::getSemester());
            }
        }

        return $this->getStudentsForCurrentEnrollment($data->unitCode);
    }

    /**
     * @param string $unitCode
     * @return array of StudentEnrollments
     */
    public function getStudentsForCurrentEnrollment(string $unitCode): array
    {
        $studentsList = [];
        $students =
            $this->unitRepository->findStudentIdsInEnrollment($unitCode, Utility::getYear(), Utility::getSemester());

        $count = 1;
        foreach ($students as $student)
        {
            array_push($studentsList, new StudentEnrollmentResponse($count++, $student));
        }

        return $studentsList;
    }

    public function getStudentPastEnrollmentsByUnit(string $unitCode, string $studentId)
    {
        $enrollmentsList = [];
        $enrollments = $this->unitRepository->getStudentPastEnrollments($unitCode, $studentId);

        foreach ($enrollments as $enrollment)
        {
            array_push($enrollmentsList, $enrollment['SEM']);
        }

        return $enrollmentsList;
    }
}
