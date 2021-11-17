<?php


namespace App\Repository;


use App\DTO\Request\SubmitAssignmentRequest;
use App\DTO\SubmissionsDTO;
use App\Models\Submission;
use Illuminate\Database\Connection;

class SubmissionRepository extends BaseRepository
{

    /**
     * SubmissionRepository constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
    }

    /**
     * @param SubmitAssignmentRequest $request
     * @param string $studentId
     * @param string $date
     * @return int submissionId
     */
    public function createSubmission(SubmitAssignmentRequest $request, string $studentId, string $date): int
    {
        $submission = Submission::create([
            'STUDENT_ID' => $studentId,
            'ASSIGNMENT_ID' => $request->assignmentId,
            'SUBMISSION_DATE' => $date,
            'FILE' => $request->fileLocation,
            'NUM_REVIEWS' => 0
        ]);

        return $submission->id;
    }

    /**
     * @param int $assignmentId
     * @param string $studentId
     * @return Submission submission details or null if doesn't exist
     */
    public function findByAssignmentAndStudentIds(int $assignmentId, string $studentId)
    {
        $submission = Submission::where('ASSIGNMENT_ID', $assignmentId)->where('STUDENT_ID', $studentId);

        if ($submission->exists()) {
            return $submission->first();
        }

        return null;
    }

    /**
     * @param Submission $submission
     * @param SubmitAssignmentRequest $request
     * @param string $date
     * @return int id
     */
    public function updateSubmission(Submission $submission, SubmitAssignmentRequest $request, string $date)
    {
        Submission::where('ASSIGNMENT_ID', $submission->ASSIGNMENT_ID)
            ->where('STUDENT_ID', $submission->STUDENT_ID)
            ->update([
                'SUBMISSION_DATE' => $date,
                'FILE' => $request->fileLocation
            ]);

        return $submission->SUBMISSION_ID;
    }

    public function findSubmissionsFromAssignment(int $assignmentId)
    {
        $submissions = Submission::select('SUBMISSION_ID', 'STUDENT_ID', 'NUM_REVIEWS')->
        where('ASSIGNMENT_ID', $assignmentId);

        return $submissions->get();
    }

    public function findStudentIdsFromAssignment(int $assignmentId)
    {
        $submissions = Submission::select('STUDENT_ID')->where('ASSIGNMENT_ID', $assignmentId);

        return $submissions->get();
    }

    public function findSubmissionWithReviewsLessThanLimit(int $assignmentId, int $limit)
    {
        $submissions = Submission::select('SUBMISSION_ID')->
        where('ASSIGNMENT_ID', $assignmentId)->where('NUM_REVIEWS', '<', $limit);

        return $submissions->get();
    }

    public function retrieveSubmissionsPerTopic(int $topicId)
    {
        $submissions = Submission::select('SUBMISSION_ID', 'SUBMISSION.STUDENT_ID', 'NUM_REVIEWS')
            ->join('STUDENT_TOPIC','SUBMISSION.STUDENT_ID','STUDENT_TOPIC.STUDENT_ID')
            ->join('TOPIC','STUDENT_TOPIC.TOPIC_ID','TOPIC.TOPIC_ID')
            ->where('TOPIC.TOPIC_ID', $topicId);

        return $submissions->get();
    }
}
