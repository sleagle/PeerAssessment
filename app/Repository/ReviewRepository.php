<?php


namespace App\Repository;


use App\DTO\Request\PeerFeedbackMarkingRequest;
use App\Models\Review;
use Illuminate\Database\Connection;

class ReviewRepository extends BaseRepository
{
    /**
     * ReviewRepository constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
    }

    /**
     * @param int $submissionId
     * @param int $studentId
     * @return int
     */
    public function createReview(int $submissionId, int $studentId): int
    {
        $review = Review::create([
            'SUBMISSION_ID' => $submissionId,
            'REVIEWER_ID' => $studentId,
            'IS_COMPLETE' => false,
            'FEEDBACK_MARK' => 0,
            'FEEDBACK_COMMENTS' => '',
        ]);

        return $review->id;
    }

    public function getReviewsForFeedbackByAssignmentAndStudent(string $studentId, int $assignmentId)
    {
        return Review::select()
            ->join('SUBMISSION', 'SUBMISSION.SUBMISSION_ID', 'REVIEW.SUBMISSION_ID')
            ->where('SUBMISSION.STUDENT_ID', $studentId)
            ->where('SUBMISSION.ASSIGNMENT_ID', $assignmentId)
            ->get();
    }

    /*
    select r.REVIEW_ID, r.SUBMISSION_ID, s.FILE from REVIEW r
    inner join SUBMISSION s on s.SUBMISSION_ID = r.SUBMISSION_ID
    where s.SUBMISSION_ID in (select SUBMISSION_ID FROM passapp.SUBMISSION where ASSIGNMENT_ID = 1)
    and r.REVIEWER_ID = '510346';

     */
    public function getReviewsToMakeByAssignmentAndStudent(string $studentId, int $assignmentId)
    {
        return Review::select('REVIEW.REVIEW_ID', 'REVIEW.SUBMISSION_ID', 'SUBMISSION.FILE')
            ->join('SUBMISSION', 'SUBMISSION.SUBMISSION_ID', 'REVIEW.SUBMISSION_ID')
            ->whereIn('SUBMISSION.SUBMISSION_ID', function ($query) use ($assignmentId) {
                $query->select('SUBMISSION.SUBMISSION_ID')->from('SUBMISSION')
                    ->where('SUBMISSION.ASSIGNMENT_ID', $assignmentId);
            })
            ->where('REVIEW.REVIEWER_ID', $studentId)
            ->get();
    }

    public function createFeedbackReview(PeerFeedbackMarkingRequest $peerFeedbackMarkingRequest)
    {
        $review = Review::where('REVIEW_ID', $peerFeedbackMarkingRequest->reviewId)
            ->update([
                'FEEDBACK_MARK' => $peerFeedbackMarkingRequest->feedbackMark,
                'FEEDBACK_COMMENTS' => $peerFeedbackMarkingRequest->feedbackComment,
            ]);

        return 0;
    }
}
