<?php


namespace App\DTO;


class MarkingCriteriaDTO
{
    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $mark;

    /**
     * @var bool
     */
    public $containSubCategory;

    /**
     * @var CriteriaDTO
     */
    public $hdCriteria;

    /**
     * @var CriteriaDTO
     */
    public $dnCriteria;

    /**
     * @var CriteriaDTO
     */
    public $crCriteria;

    /**
     * @var CriteriaDTO
     */
    public $ppCriteria;

    /**
     * @var string
     */
    public $nnDescription;

    /**
     * MarkingCriteriaDTO constructor.
     * @param $criteria
     * @param CriteriaDTO $hdCriteria
     * @param CriteriaDTO $dnCriteria
     * @param CriteriaDTO $crCriteria
     * @param CriteriaDTO $ppCriteria
     */
    public function __construct($criteria, CriteriaDTO $hdCriteria, CriteriaDTO $dnCriteria, CriteriaDTO $crCriteria,
                                CriteriaDTO $ppCriteria)
    {
        $this->description = $criteria['CRITERIA_NAME'];
        $this->mark = $criteria['CRITERIA_MARKS'];;
        $this->containSubCategory = $criteria['CONTAIN_SUB_CATEGORY'];;
        $this->hdCriteria = $hdCriteria;
        $this->dnCriteria = $dnCriteria;
        $this->crCriteria = $crCriteria;
        $this->ppCriteria = $ppCriteria;
        $this->nnDescription = $criteria['NN_CRITERIA_DESC'];;
    }


}
