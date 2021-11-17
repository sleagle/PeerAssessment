<?php


namespace App\DTO\Response;


class AssignmentPeersResponse
{
    /**
     * @var string
     */
    public $unitCode;

    /**
     * @var int
     */
    public $allocationStrategy;

    /**
     * @var int
     */
    public $numPeers;

    /**
     * AssignmentPeersResponse constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->unitCode = $data[0]['UNIT_CODE'];
        $this->allocationStrategy = $data[0]['ALLOCATION_CRITERIA'];
        $this->numPeers = $data[0]['NO_OF_REVIEWS'];
    }
}
