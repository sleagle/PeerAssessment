<?php


namespace App\DTO\Request;


use App\DTO\MarkingCriteriaDTO;
use App\DTO\SubCriteriaDTO;

class AssignmentMarkingCriteriaUpdateRequest
{
    /**
     * @var array
     */
    public $markingCriteria;

    /**
     * @var array
     */
    public $feedbackCriteria;

    public function extractFeedBackCriteriaData()
    {
        $feedbacks = $this->feedbackCriteria;
        $mapper = new \JsonMapper();
        $feedbackCriteriaArray = $mapper->mapArray($feedbacks, array(), FeedbackCriteriaDTO::class);
        $this->feedbackCriteria = $feedbackCriteriaArray;

        return $this;
    }

    public function extractMarkingCriteriaData() {

        $markingCriteriaArray = array();
        $mapper = new \JsonMapper();
        $tempArray = $mapper->mapArray($this->markingCriteria, array(),
            MarkingCriteriaDTO::class);

        foreach ($tempArray as $markingCriteria)
        {
            $markingCriteria->hdCriteria->subCriteria =
                $mapper->mapArray($markingCriteria->hdCriteria->subCriteria, array(), SubCriteriaDTO::class);

            $markingCriteria->dnCriteria->subCriteria =
                $mapper->mapArray($markingCriteria->dnCriteria->subCriteria, array(), SubCriteriaDTO::class);

            $markingCriteria->crCriteria->subCriteria =
                $mapper->mapArray($markingCriteria->crCriteria->subCriteria, array(), SubCriteriaDTO::class);

            $markingCriteria->ppCriteria->subCriteria =
                $mapper->mapArray($markingCriteria->ppCriteria->subCriteria, array(), SubCriteriaDTO::class);

            array_push($markingCriteriaArray, $markingCriteria);
        }

        $this->markingCriteria = $markingCriteriaArray;

        return $this;
    }

}
