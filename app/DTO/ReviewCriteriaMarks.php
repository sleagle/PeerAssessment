<?php


namespace App\DTO;


class ReviewCriteriaMarks
{
    /** @var int **/
    public $rowNum;

    /** @var int **/
    public $reviewId;

    /** @var int **/
    public $submissionId;

    /** @var string **/
    public $file;

    /** @var array */
    public $reviewCriteria;

    /**
     * ReviewCriteriaMarks constructor.
     * @param $rowNum
     * @param $review
     */
    public function __construct($rowNum, $review)
    {
        $this->rowNum = $rowNum;
        $this->reviewId = $review->REVIEW_ID;
        $this->submissionId = $review->SUBMISSION_ID;
        $this->file = $review->FILE;
        $this->reviewCriteria = [];
    }
}
