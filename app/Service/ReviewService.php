<?php


namespace App\Service;


use App\DTO\AssignmentCriteriaForMarkingDTO;
use App\DTO\Request\PeerFeedbackMarkingRequest;
use App\DTO\Request\PeerMarkingRequest;
use App\DTO\Response\AssignmentMarkingRetrievalResponse;
use App\DTO\Response\PeerMarkingDTO;
use App\DTO\ReviewCriteriaDTO;
use App\DTO\ReviewCriteriaMarks;
use App\Repository\AssignmentRepository;
use App\Repository\CriteriaRepository;
use App\Repository\CriteriaReviewRepository;
use App\Repository\ReviewRepository;

class ReviewService
{
    private $reviewRepository;

    private $criteriaRepository;

    private $criteriaReviewRepository;

    private $assignmentRepository;

    /**
     * ReviewService constructor.
     * @param ReviewRepository $reviewRepository
     * @param CriteriaRepository $criteriaRepository
     * @param CriteriaReviewRepository $criteriaReviewRepository
     * @param AssignmentRepository $assignmentRepository
     */
    public function __construct(ReviewRepository $reviewRepository, CriteriaRepository $criteriaRepository,
                                CriteriaReviewRepository $criteriaReviewRepository, AssignmentRepository $assignmentRepository)
    {
        $this->reviewRepository = $reviewRepository;
        $this->criteriaRepository = $criteriaRepository;
        $this->criteriaReviewRepository = $criteriaReviewRepository;
        $this->assignmentRepository = $assignmentRepository;
    }

    public function getReviewsForFeedbackFromSubmission(string $studentId, int $assignmentID)
    {
        echo $studentId . " " . $assignmentID;
        return $this->reviewRepository->getReviewsForFeedbackByAssignmentAndStudent($studentId, $assignmentID);
    }

    public function getReviewsToMakeFromAssignment(string $studentId, int $assignmentID)
    {
        $assignmentCriteria = [];
        $Criteria = $this->criteriaRepository->getCriteriaByAssignmentId($assignmentID);

        $counter = 1;
        foreach ($Criteria as $criterion)
        {
            array_push($assignmentCriteria, new AssignmentCriteriaForMarkingDTO($counter, $criterion));
            $counter++;
        }

        $reviewsToMake = [];

        $reviews =  $this->reviewRepository->getReviewsToMakeByAssignmentAndStudent($studentId, $assignmentID);

        $counter = 1;
        foreach ($reviews as $review)
        {
            $reviewCriteriaMarks = new ReviewCriteriaMarks($counter, $review);
            $tempCriteriaReview = [];
            foreach ($Criteria as $criterion)
            {
                $criteriaReview = $this->criteriaReviewRepository->getCriteriaReviewByReviewId($review->REVIEW_ID,
                    $criterion->CRITERIA_ID);
                array_push($tempCriteriaReview, new ReviewCriteriaDTO($criterion->CRITERIA_ID, $criteriaReview));
            }

            $reviewCriteriaMarks->reviewCriteria = $tempCriteriaReview;
            //var_dump($reviewCriteriaMarks);
            array_push($reviewsToMake, $reviewCriteriaMarks);
            $counter++;
        }

        $unitCode = $this->assignmentRepository->getUnitCodeByAssignmentId($assignmentID)[0]->UNIT_CODE;
        return new AssignmentMarkingRetrievalResponse($unitCode,$assignmentCriteria, $reviewsToMake);
    }

    public function createPeerReview(PeerMarkingRequest $peerMarkingRequest)
    {
        foreach ($peerMarkingRequest->marking as $mark)
        {
            $this->criteriaReviewRepository->createCriteriaReview($peerMarkingRequest->reviewId, $mark);
        }
        return 0;
    }

    public function createPeerFeedReview(PeerFeedbackMarkingRequest $peerFeedbackMarkingRequest): int
    {
        return $this->reviewRepository->createFeedbackReview($peerFeedbackMarkingRequest);
    }
}
