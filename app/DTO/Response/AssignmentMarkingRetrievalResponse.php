<?php


namespace App\DTO\Response;


class AssignmentMarkingRetrievalResponse
{
    /** @var string */
    public $unitCode;

    /** @var array */
    public $criteria;

    /** @var array */
    public $marking;

    /**
     * AssignmentMarkingRetrievalResponse constructor.
     * @param string $unitCode
     * @param array $criteria
     * @param array $marking
     */
    public function __construct(string $unitCode, array $criteria, array $marking)
    {
        $this->unitCode = $unitCode;
        $this->criteria = $criteria;
        $this->marking = $marking;
    }
}
