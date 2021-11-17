<?php


namespace App\DTO\Response;


use App\DTO\Request\FeedbackCriteriaDTO;

class AssignmentMarkingSchemeResponse
{

    /**
     * @var string
     */
    public $unitCode;
    /**
     * @var array
     */
    public $markingCriteria;

    /**
     * @var array
     */
    public $feedbackCriteria;

    /**
     * AssignmentMarkingSchemeResponse constructor.
     * @param $unitCode
     */
    public function __construct($unitCode)
    {
        $this->unitCode = $unitCode['UNIT_CODE'];
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
