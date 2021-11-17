<?php


namespace App\DTO\Request;


class AllocatePeersForReviewRequest
{
    /**
     * @var int
     */
    public $allocationStrategy;

    /**
     * @var int
     */
    public $numPeers;
}
