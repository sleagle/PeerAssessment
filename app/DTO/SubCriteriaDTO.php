<?php


namespace App\DTO;


class SubCriteriaDTO
{

    /**
     * @var string
     */
    public $mark;

    /**
     * @var string
     */
    public $description;

    /**
     * SubCriteriaDTO constructor.
     * @param $subCriteria
     */
    public function __construct($subCriteria)
    {
        $this->mark = $subCriteria['SUB_CRITERIA_MARKS'];
        $this->description = $subCriteria['SUB_CRITERIA_DESC'];
    }


}
