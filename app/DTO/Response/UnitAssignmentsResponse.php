<?php


namespace App\DTO\Response;


class UnitAssignmentsResponse
{
    /** @var array */
    public $currentAssignments;

    /** @var array */
    public $pastAssignments;

    /**
     * UnitAssignmentsResponse constructor.
     * @param array $currentAssignments
     * @param array $pastAssignments
     */
    public function __construct(array $currentAssignments, array $pastAssignments)
    {
        $this->currentAssignments = $currentAssignments;
        $this->pastAssignments = $pastAssignments;
    }


}
