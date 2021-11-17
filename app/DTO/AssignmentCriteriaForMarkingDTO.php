<?php


namespace App\DTO;


class AssignmentCriteriaForMarkingDTO
{
    /** @var int */
    public $rowNum;

    /** @var int */
    public $criteriaId;

    /** @var string */
    public $criteria;

    /**
     * AssignmentCriteriaForMarkingDTO constructor.
     * @param $rowNum
     * @param $criteria
     */
    public function __construct($rowNum, $criteria)
    {
        $this->rowNum = $rowNum;
        $this->criteriaId = $criteria->CRITERIA_ID;
        $this->criteria = $criteria->CRITERIA_NAME;
    }
}
