<?php


namespace App\DTO\Request;


class FeedbackCriteriaDTO
{

    /**
     * @var string
     */
    public $criteria;

    /**
     * @var integer
     */
    public $marks;

    /**
     * @var string
     */
    public $hdCriteria;

    /**
     * @var string
     */
    public $dnCriteria;

    /**
     * @var string
     */
    public $crCriteria;

    /**
     * @var string
     */
    public $ppCriteria;

    /**
     * @var string
     */
    public $nnCriteria;

    /**
     * FeedbackCriteriaDTO constructor.
     * @param $feedbackCriteria
     */
    public function __construct($feedbackCriteria)
    {
        $this->criteria = $feedbackCriteria['CRITERIA_NAME'];
        $this->marks = $feedbackCriteria['CRITERIA_MARKS'];
        $this->hdCriteria = $feedbackCriteria['HD_CRITERIA_DESC'];
        $this->dnCriteria = $feedbackCriteria['DN_CRITERIA_DESC'];
        $this->crCriteria = $feedbackCriteria['CR_CRITERIA_DESC'];
        $this->ppCriteria = $feedbackCriteria['PP_CRITERIA_DESC'];
        $this->nnCriteria = $feedbackCriteria['NN_CRITERIA_DESC'];
    }


}
