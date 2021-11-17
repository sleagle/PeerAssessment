<?php


namespace App\DTO\Response;


class AssignmentTopicAllocationResponse
{
    /** @var string */
    public $unitCode;

    /** @var array */
    public $topicAllocation;

    /**
     * AssignmentTopicAllocationResponse constructor.
     * @param $unitCode
     * @param array $topicAllocation
     */
    public function __construct($unitCode, array $topicAllocation)
    {
        $this->unitCode = $unitCode;
        $this->topicAllocation = $topicAllocation;
    }
}
