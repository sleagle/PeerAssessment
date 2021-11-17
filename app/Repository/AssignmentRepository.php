<?php


namespace App\Repository;


use App\DTO\Request\AllocatePeersForReviewRequest;
use App\DTO\Request\AssignmentDeadlinesUpdateRequest;
use App\DTO\Request\AssignmentInfoUpdateRequest;
use App\DTO\Request\CreateAssignmentRequest;
use App\Exceptions\PeerAssessmentException;
use App\Models\Assignment;
use App\Utility\Utility;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\DB;

class AssignmentRepository extends BaseRepository
{
    /**
     * AssignmentRepository constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
    }

    /**
     * @param CreateAssignmentRequest $data
     * @param int $year
     * @param string $semester
     * @return int newly created assignments id
     */
    public function createAssignment(CreateAssignmentRequest $data, int $year, string $semester): int
    {
        $assignment = Assignment::create([
            'TITLE' => $data->title,
            'YEAR' => $year,
            'SEMESTER' => $semester,
            'OUTCOME' => $data->learningOutcome,
            'SCENARIO' => $data->scenario,
            'TOPIC_SELECTION_DEADLINE' => $data->deadline->topicSelection,
            'ASSIGNMENT_SUBMISSION_DEADLINE' => $data->deadline->assignmentSubmission,
            'ASSIGNMENT_SUBMISSION_CLOSING' => $data->deadline->assignmentSubmissionClosing,
            'ASSIGNMENT_MARKING_OPENING_DATE' => $data->deadline->assignmentMarkingOpens,
            'ASSIGNMENT_MARKING_DEADLINE' => $data->deadline->assignmentMarkingEnds,
            'FEEDBACK_MARKING_OPENING_DATE' => $data->deadline->feedbackMarkingOpens,
            'FEEDBACK_MARKING_DEADLINE' => $data->deadline->feedbackMarkingEnds,
            'NO_OF_REVIEWS' => $data->numOfReviews,
            'ALLOCATION_CRITERIA' => $data->allocationStrategy,
            'UNIT_CODE' => $data->unit,
        ]);

        return $assignment->id;
    }

    public function getCount()
    {

    }

    public function getBasicAssignmentInfoById(int $assignmentId)
    {
        return Assignment::select('TITLE','OUTCOME','SCENARIO','UNIT_CODE')
            ->where('ASSIGNMENT_ID', $assignmentId)->get();
    }

    public function getBasicAssignmentDeadlinesById(int $assignmentId)
    {
        return Assignment::select('UNIT_CODE', 'TOPIC_SELECTION_DEADLINE', 'ASSIGNMENT_SUBMISSION_DEADLINE',
            'ASSIGNMENT_SUBMISSION_CLOSING', 'ASSIGNMENT_MARKING_OPENING_DATE', 'ASSIGNMENT_MARKING_DEADLINE',
            'FEEDBACK_MARKING_OPENING_DATE', 'FEEDBACK_MARKING_DEADLINE')->where('ASSIGNMENT_ID', $assignmentId)->get();
    }

    public function getUnitCodeById(int $assignmentId)
    {
        return Assignment::select('UNIT_CODE')
            ->where('ASSIGNMENT_ID', $assignmentId)->get();
    }

    public function getAssignmentById(int $assignmentId)
    {
        return Assignment::where('ASSIGNMENT_ID', $assignmentId)->get();
    }

    public function getAssignmentsByUnitCode(string $unitCode)
    {
        $assignments = Assignment::select('ASSIGNMENT_ID', 'TITLE', 'TOPIC_SELECTION_DEADLINE')
            ->where('UNIT_CODE', $unitCode)->get();

        if (empty($assignments))
        {
            $passException = new PeerAssessmentException();
            $passException->setCode("ERR004");
            $passException->setMessage("This Unit has no associated assignments");

            throw $passException;
        }

        return $assignments;
    }

    /**
     * @param string $unitCode
     * @param string $sem
     * @param int $year
     * @return mixed
     * @throws PeerAssessmentException
     */
    public function getCurrentAssignmentsByUnitCode(string $unitCode, string $sem, int $year)
    {
        $assignments = Assignment::select('ASSIGNMENT_ID', 'TITLE', 'TOPIC_SELECTION_DEADLINE')
            ->where('UNIT_CODE', $unitCode)->where('YEAR', $year)->where('SEMESTER', $sem)->get();

        if (empty($assignments))
        {
            $passException = new PeerAssessmentException();
            $passException->setCode("ERR004");
            $passException->setMessage("This Unit has no associated assignments");

            throw $passException;
        }
        return $assignments;
    }

    /**
     * @param string $unitCode
     * @param array $assignmentIds
     * @return mixed
     * @throws PeerAssessmentException
     */
    public function getPastAssignmentsByUnitCode(string $unitCode, array $assignmentIds)
    {
        $assignments = Assignment::select('ASSIGNMENT_ID', 'TITLE', 'TOPIC_SELECTION_DEADLINE', 'YEAR', 'SEMESTER')
            ->where('UNIT_CODE', $unitCode)->whereNotIn('ASSIGNMENT_ID', $assignmentIds)
            ->orderBy('YEAR')->orderBy('SEMESTER')->get();

        if (empty($assignments))
        {
            $passException = new PeerAssessmentException();
            $passException->setCode("ERR004");
            $passException->setMessage("This Unit has no associated assignments");

            throw $passException;
        }

        return $assignments;
    }

    /**
     * @param string $unitCode
     * @param string $currentOffering
     * @return mixed
     * @throws PeerAssessmentException
     */
    public function getAssignmentOfferingsByUnit(string $unitCode, string $currentOffering)
    {
        $assignments = Assignment::select(DB::raw("CONCAT(SEMESTER, ' - ',YEAR) AS OFFERING"))->distinct('OFFERING')
            ->where('UNIT_CODE', $unitCode)->where(DB::raw("CONCAT(SEMESTER, ' - ',YEAR)"), '!=', $currentOffering)
            ->orderBy('OFFERING')->get();

        if (empty($assignments))
        {
            $passException = new PeerAssessmentException();
            $passException->setCode("ERR004");
            $passException->setMessage("This Unit has no associated assignments");

            throw $passException;
        }

        return $assignments;
    }

    public function retrieveAssignmentPeers($assignmentId)
    {
        return Assignment::select('NO_OF_REVIEWS','ALLOCATION_CRITERIA','UNIT_CODE')
            ->where('ASSIGNMENT_ID', $assignmentId)->get();
    }

    public function updateAssignmentPeers(AllocatePeersForReviewRequest $request, $assignmentId)
    {
        $assignment = Assignment::where('ASSIGNMENT_ID', $assignmentId)
            ->update([
                'NO_OF_REVIEWS' => $request->numPeers,
                'ALLOCATION_CRITERIA' => $request->allocationStrategy
            ]);

        return 1;
    }

    public function updateAssignmentInfo(AssignmentInfoUpdateRequest $request, $assignmentId)
    {
        $assignment = Assignment::where('ASSIGNMENT_ID', $assignmentId)
            ->update([
                'TITLE' => $request->title,
                'OUTCOME' => $request->learningOutcome,
                'SCENARIO' => $request->scenario
            ]);

        return 1;
    }

    public function updateAssignmentDeadline(AssignmentDeadlinesUpdateRequest $request, $assignmentId)
    {
        $assignment = Assignment::where('ASSIGNMENT_ID', $assignmentId)
            ->update([
                'TOPIC_SELECTION_DEADLINE' => $request->deadline->topicSelection,
                'ASSIGNMENT_SUBMISSION_DEADLINE' => $request->deadline->assignmentSubmission,
                'ASSIGNMENT_SUBMISSION_CLOSING' => $request->deadline->assignmentSubmissionClosing,
                'ASSIGNMENT_MARKING_OPENING_DATE' => $request->deadline->assignmentMarkingOpens,
                'ASSIGNMENT_MARKING_DEADLINE' => $request->deadline->assignmentMarkingEnds,
                'FEEDBACK_MARKING_OPENING_DATE' => $request->deadline->feedbackMarkingOpens,
                'FEEDBACK_MARKING_DEADLINE' => $request->deadline->feedbackMarkingEnds,
            ]);

        return 1;
    }

    /**
     * @param string $unitCode
     * @param string $studentId
     * @param string $sem
     * @param int $year
     * @return mixed
     * @throws PeerAssessmentException
     */
    public function getCurrentStudentAssignmentsByUnitCode(string $unitCode, string $studentId, string $sem, int $year)
    {
        $assignments = Assignment::select('ASSIGNMENT_ID', 'TITLE', 'TOPIC_SELECTION_DEADLINE')
            ->join('ENROLLED_IN', 'ENROLLED_IN.UNIT_CODE', 'ASSIGNMENT.UNIT_CODE')
            ->where('ENROLLED_IN.STUDENT_ID', $studentId)
            ->where('ENROLLED_IN.SEMESTER', $sem)
            ->where('ENROLLED_IN.YEAR', $year)
            ->whereRaw("CONCAT('Sem ', $sem) = ASSIGNMENT.SEMESTER")
            ->where('ASSIGNMENT.YEAR', $year)
            ->where('ENROLLED_IN.UNIT_CODE', $unitCode)
            ->get();

        if (empty($assignments))
        {
            $passException = new PeerAssessmentException();
            $passException->setCode("ERR004");
            $passException->setMessage("This Unit has no associated assignments");

            throw $passException;
        }
        return $assignments;
    }

    public function getStudentPastAssignmentByUnit(string $unitCode, string $studentId, array $assignmentIds, string $sem, int $year)
    {
        return Assignment::select('ASSIGNMENT_ID','TITLE','TOPIC_SELECTION_DEADLINE','ASSIGNMENT.YEAR', 'ASSIGNMENT.SEMESTER')
            ->join('ENROLLED_IN', 'ENROLLED_IN.UNIT_CODE', 'ASSIGNMENT.UNIT_CODE')
            ->where('ENROLLED_IN.UNIT_CODE', $unitCode)
            ->where('ENROLLED_IN.STUDENT_ID', $studentId)
            ->whereRaw("CONCAT('Sem ', $sem) != ASSIGNMENT.SEMESTER")
            ->where('ASSIGNMENT.YEAR', '!=', $year)
            ->whereNotIn('ASSIGNMENT.ASSIGNMENT_ID', $assignmentIds)->get();
    }

    public function getUnitCodeByAssignmentId(int $assignmentId)
    {
        return Assignment::select('UNIT_CODE')->where('ASSIGNMENT_ID', $assignmentId)->get();
    }
}
