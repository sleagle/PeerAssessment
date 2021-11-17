<?php


namespace App\Service;

use App\DTO\LecturerDTO;
use App\DTO\LecturersResponseDTO;
use App\DTO\Request\CreateUserRequest;
use App\DTO\Response\LecturersResponse;
use App\DTO\UserDTO;
use App\Exception\PeerAssessmentException;
use App\Repository\LecturerRepository;
use App\Repository\UnitRepository;
use App\Repository\UserRepository;
use UnexpectedValueException;
use Exception;

final class LecturerService
{

    private $lecturerRepository;

    private $unitRepository;

    private $userRepository;

    public function __construct(LecturerRepository $lecturerRepository, UnitRepository $unitRepository,
                                UserRepository $userRepository)
    {
        $this->lecturerRepository = $lecturerRepository;
        $this->unitRepository = $unitRepository;
        $this->userRepository = $userRepository;
    }

    public function createLecturer(CreateUserRequest $lecturerData): int
    {
        if (empty($lecturerData->username))
        {
            throw new UnexpectedValueException('Username Required');
        }

        $userId = $this->userRepository->createUser(new UserDTO($lecturerData->username,
            $lecturerData->password, 2));

        return $this->lecturerRepository->insertLecturer($lecturerData, $userId);
    }

    /**
     * @return LecturersResponse
     */
    public function  getAllLecturers(): LecturersResponse
    {
        $lecturers = $this->lecturerRepository->getAll();
        $lecturersResponse = array();

        foreach ($lecturers as $lecturer)
        {
            $lecturerResponseDTO = new LecturersResponseDTO($lecturer->LECTURER_ID,
                $lecturer->FIRST_NAME . " " . $lecturer->LAST_NAME);

            array_push($lecturersResponse, $lecturerResponseDTO);
        }

        return new LecturersResponse($lecturersResponse);
    }
}
