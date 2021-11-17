<?php


namespace App\DTO;


class SubmissionsDTO
{

    /** @var int **/
    public $submissionId;

    /** @var int **/
    public $studentId;

    /** @var int **/
    public $numReview;

    /**
     * SubmissionsDTO constructor.
     * @param $dataObj
     */
    public function __construct($dataObj)
    {
        $this->submissionId = $dataObj['SUBMISSION_ID'];
        $this->studentId = $dataObj['STUDENT_ID'];
        $this->numReview = $dataObj['NUM_REVIEWS'];
    }


}
