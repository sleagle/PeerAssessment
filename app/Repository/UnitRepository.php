<?php


namespace App\Repository;


use App\DTO\Request\CreateUnitRequest;
use App\Exceptions\PeerAssessmentException;
use App\Models\EnrolledIn;
use App\Models\Unit;
use App\Utility\Utility;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\DB;

final class UnitRepository extends BaseRepository
{
    /**
     * UnitRepository constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
    }

    public function createUnit(CreateUnitRequest $data): int
    {
        $unit = Unit::create([
            'UNIT_CODE' => $data->unitCode,
            'UNIT_NAME' => $data->unitName,
            'LECTURER_ID' => $data->lectureId,
        ]);

        return $unit->id;
    }

    public function getUnitsByLecturer(int $lecturerId)
    {
        $units = Unit::where('LECTURER_ID', $lecturerId)->get();

        if (empty($units))
        {
            $passException = new PeerAssessmentException();
            $passException->setCode("ERR003");
            $passException->setMessage("The lecturer has no units");

            throw $passException;
        }

        return $units;
    }

    public function getUnitByUnitCode($unitCode)
    {
        return Unit::where('UNIT_CODE', $unitCode)->get();
    }

    public function createEnrollment($unitCode, $studentId, $year, $semester)
    {
        EnrolledIn::create([
            'UNIT_CODE' => $unitCode,
            'STUDENT_ID' => $studentId,
            'YEAR' => $year,
            'SEMESTER' => $semester,
        ]);
    }

    public function checkEnrollment($unitCode, $studentId, $year, $semester)
    {
        $enrollment = EnrolledIn::where('STUDENT_ID', $studentId)
            ->where('UNIT_CODE', $unitCode)->where('YEAR', $year)->where('SEMESTER', $semester);

        if ($enrollment->exists())
        {
            return true;
        }
        else {
            return false;
        }
    }

    public function findStudentIdsInEnrollment($unitCode, $year, $semester)
    {
        $enrollment = EnrolledIn::select('ENROLLED_IN.STUDENT_ID','FIRST_NAME','LAST_NAME','IS_ENABLED','USERNAME')
            ->join('STUDENT', 'STUDENT.STUDENT_ID', 'ENROLLED_IN.STUDENT_ID')
            ->join('USER', 'STUDENT.USER_ID', 'USER.USER_ID')
            ->where('UNIT_CODE', $unitCode)->where('YEAR', $year)->where('SEMESTER', $semester);

        return $enrollment->get();
    }

    public function getStudentNamesAndIdsInEnrollment($unitCode, $year, $semester)
    {
        $enrollment = EnrolledIn::select(DB::raw("CONCAT(FIRST_NAME, ' ', LAST_NAME) AS NAME"), 'ENROLLED_IN.STUDENT_ID')
            ->join('STUDENT', 'STUDENT.STUDENT_ID', 'ENROLLED_IN.STUDENT_ID')
            ->join('USER', 'STUDENT.USER_ID', 'USER.USER_ID')
            ->where('UNIT_CODE', $unitCode)->where('YEAR', $year)->where('SEMESTER', $semester);

        return $enrollment->get();
    }

    public function getStudentUnits($studentId)
    {
        $units = Unit::select('UNIT.UNIT_CODE', 'UNIT_NAME')
            ->join('ENROLLED_IN', 'ENROLLED_IN.UNIT_CODE', 'UNIT.UNIT_CODE')
            ->where('ENROLLED_IN.STUDENT_ID',$studentId)->distinct();

        return $units->get();
    }

    public function getStudentPastEnrollments(string $unitCode, string $studentId)
    {
        return EnrolledIn::select(DB::raw("CONCAT('Sem ', SEMESTER, ' - ', YEAR) AS SEM"), 'SEMESTER', 'YEAR')
            ->where('UNIT_CODE', $unitCode)
            ->where('STUDENT_ID', $studentId)
            ->where('YEAR', "!=", Utility::getYear())
            ->where('SEMESTER', "!=" , Utility::getSemester())
            ->distinct()->orderBy('YEAR')->orderBy('SEMESTER')->get();
    }
}
