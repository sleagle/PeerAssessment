<?php

namespace App\DTO\Request;


class DeadlineDTO
{

    /**
     * @var \DateTime
     */
    public $topicSelection;

    /**
     * @var \DateTime
     */
    public $assignmentSubmission;

    /**
     * @var \DateTime
     */
    public $assignmentSubmissionClosing;

    /**
     * @var \DateTime
     */
    public $assignmentMarkingOpens;

    /**
     * @var \DateTime
     */
    public $assignmentMarkingEnds;

    /**
     * @var \DateTime
     */
    public $feedbackMarkingOpens;

    /**
     * @var \DateTime
     */
    public $feedbackMarkingEnds;

    /**
     * DeadlineDTO constructor.
     * @param $assignmentDetails
     */
    public function __construct($assignmentDetails)
    {
        $this->topicSelection = $assignmentDetails['TOPIC_SELECTION_DEADLINE'];
        $this->assignmentSubmission = $assignmentDetails['ASSIGNMENT_SUBMISSION_DEADLINE'];
        $this->assignmentSubmissionClosing = $assignmentDetails['ASSIGNMENT_SUBMISSION_CLOSING'];
        $this->assignmentMarkingOpens = $assignmentDetails['ASSIGNMENT_MARKING_OPENING_DATE'];
        $this->assignmentMarkingEnds = $assignmentDetails['ASSIGNMENT_MARKING_DEADLINE'];
        $this->feedbackMarkingOpens = $assignmentDetails['FEEDBACK_MARKING_OPENING_DATE'];
        $this->feedbackMarkingEnds = $assignmentDetails['FEEDBACK_MARKING_DEADLINE'];
    }


}
