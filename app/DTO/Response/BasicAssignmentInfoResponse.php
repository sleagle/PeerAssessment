<?php


namespace App\DTO\Response;


class BasicAssignmentInfoResponse
{
    /**
     * @var string
     */
    public $unit;

    /**
     * @var string
     */
    public $unitCode
    ;
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $learningOutcome;

    /**
     * @var string
     */
    public $scenario;

    /**
     * BasicAssignmentInfoResponse constructor.
     * @param $assignmentDetails
     * @param $unitDetails
     */
    public function __construct($assignmentDetails, $unitDetails)
    {
        $this->unit = $unitDetails['UNIT_CODE'] . " - " . $unitDetails['UNIT_NAME'];
        $this->unitCode = $unitDetails['UNIT_CODE'];
        $this->title = $assignmentDetails['TITLE'];
        $this->learningOutcome = $assignmentDetails['OUTCOME'];;
        $this->scenario = $assignmentDetails['SCENARIO'];;
    }


}
