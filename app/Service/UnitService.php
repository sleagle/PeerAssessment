<?php


namespace App\Service;


use App\DTO\LecturerUnitsResponseDTO;
use App\DTO\Request\CreateUnitRequest;
use App\DTO\Response\LecturerUnitsResponse;
use App\DTO\Response\StudentUnitResponse;
use App\DTO\StudentUnitResponseDTO;
use App\Exceptions\PeerAssessmentException;
use App\Repository\UnitRepository;

final class UnitService
{
    private $unitRepository;

    /**
     * UnitService constructor.
     * @param $unitRepository
     */
    public function __construct(UnitRepository $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }

    /**
     * @param $studentId
     * @return array
     */
    public function getStudentUnits($studentId): array
    {
        $studentUnits = [];
        foreach ($this->unitRepository->getStudentUnits($studentId) as $studentUnit)
        {
            array_push($studentUnits, new StudentUnitResponse($studentUnit));
        }
        return $studentUnits;
    }

    /**
     * @param CreateUnitRequest $data
     * @return int
     */
    public function createUnit(CreateUnitRequest $data): int
    {
        return $this->unitRepository->createUnit($data);
    }

    /**
     * @param int $lecturerId
     * @return LecturerUnitsResponse
     * @throws PeerAssessmentException
     */
    public function getLecturerUnits(int $lecturerId): LecturerUnitsResponse
    {

        $unitsArray = [];
        $units = $this->unitRepository->getUnitsByLecturer($lecturerId);

        foreach ($units as $unit) {
            array_push($unitsArray, new LecturerUnitsResponseDTO($unit));
        }

        return new LecturerUnitsResponse($unitsArray);
    }
}
