<?php


namespace App\DTO\Response;


use App\DTO\Request\DeadlineDTO;

class AssignmentDetailResponse
{
    /** @var int */
    public $assignmentId;

    /**
     * @var string
     */
    public $unit;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $year;

    /**
     * @var string
     */
    public $semester;

    /**
     * @var string
     */
    public $learningOutcome;

    /**
     * @var string
     */
    public $scenario;

    /**
     * @var integer
     */
    public $numOfReviews;

    /**
     * @var string
     */
    public $allocationStrategy;

    /**
     * @var DeadlineDTO
     */
    public $deadline;

    /**
     * @var array
     */
    public $topicSpecification;

    /**
     * @var array
     */
    public $markingCriteria;

    /**
     * @var array
     */
    public $feedbackCriteria;

    /**
     * AssignmentDetailResponse constructor.
     * @param $assignmentDetails
     */
    public function __construct($assignmentDetails)
    {
        $this->assignmentId = $assignmentDetails['ASSIGNMENT_ID'];
        $this->unit = $assignmentDetails['UNIT_CODE'];
        $this->title = $assignmentDetails['TITLE'];
        $this->semester = $assignmentDetails['SEMESTER'];
        $this->year = $assignmentDetails['YEAR'];
        $this->learningOutcome = $assignmentDetails['OUTCOME'];
        $this->scenario = $assignmentDetails['SCENARIO'];
        $this->numOfReviews = $assignmentDetails['NO_OF_REVIEWS'];
        $this->allocationStrategy = $assignmentDetails['ALLOCATION_CRITERIA'];
        $this->deadline = new DeadlineDTO($assignmentDetails);
    }

    /**
     * @param array $topicSpecification
     */
    public function setTopicSpecification(array $topicSpecification): void
    {
        $this->topicSpecification = $topicSpecification;
    }

    /**
     * @param array $markingCriteria
     */
    public function setMarkingCriteria(array $markingCriteria): void
    {
        $this->markingCriteria = $markingCriteria;
    }

    /**
     * @param array $feedbackCriteria
     */
    public function setFeedbackCriteria(array $feedbackCriteria): void
    {
        $this->feedbackCriteria = $feedbackCriteria;
    }
}
