<?php


namespace App\DTO;


class ReviewCriteriaDTO
{
    /** @var int **/
    public $criteriaId;

    /** @var int **/
    public $mark;

    /** @var string **/
    public $grade;

    /** @var string **/
    public $comment;

    /**
     * ReviewCriteriaDTO constructor.
     * @param int $criteriaId
     * @param $criteriaReview
     */
    public function __construct(int $criteriaId, $criteriaReview)
    {
        if ($criteriaReview->isEmpty())
        {
            $this->criteriaId = $criteriaId;
            $this->mark = 0;
            $this->grade = "";
            $this->comment = "";
        }
        else
        {
            $this->criteriaId = $criteriaReview[0]->CRITERIA_ID;
            $this->mark = $criteriaReview[0]->MARK;
            $this->grade = $criteriaReview[0]->GRADE;
            $this->comment = $criteriaReview[0]->COMMENT;
        }
    }
}
