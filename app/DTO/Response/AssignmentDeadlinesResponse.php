<?php


namespace App\DTO\Response;


use DateTime;

class AssignmentDeadlinesResponse
{
    /** @var string */
    public $unitCode;

    /** @var DateTime */
    public $topicSelection;

    /** @var DateTime */
    public $assignmentSubmission;

    /** @var DateTime */
    public $assignmentSubmissionClosing;

    /** @var DateTime */
    public $assignmentMarkingOpening;

    /** @var DateTime */
    public $assignmentMarkingClosing;

    /** @var DateTime */
    public $assignmentFeedbackMarkingOpening;

    /** @var DateTime */
    public $assignmentFeedbackMarkingClosing;

    /**
     * AssignmentDeadlinesResponse constructor.
     * @param $assignmentDeadlines
     */
    public function __construct($assignmentDeadlines)
    {
        //date_default_timezone_set('UTC');
        $this->unitCode = $assignmentDeadlines['UNIT_CODE'];
        $this->topicSelection = date($assignmentDeadlines['TOPIC_SELECTION_DEADLINE']);
        $this->assignmentSubmission = $assignmentDeadlines['ASSIGNMENT_SUBMISSION_DEADLINE'];;
        $this->assignmentSubmissionClosing = $assignmentDeadlines['ASSIGNMENT_SUBMISSION_CLOSING'];;
        $this->assignmentMarkingOpening = $assignmentDeadlines['ASSIGNMENT_MARKING_OPENING_DATE'];;
        $this->assignmentMarkingClosing = $assignmentDeadlines['ASSIGNMENT_MARKING_DEADLINE'];;
        $this->assignmentFeedbackMarkingOpening = $assignmentDeadlines['FEEDBACK_MARKING_OPENING_DATE'];;
        $this->assignmentFeedbackMarkingClosing = $assignmentDeadlines['FEEDBACK_MARKING_DEADLINE'];;
    }

   // private function getDateInF
}
