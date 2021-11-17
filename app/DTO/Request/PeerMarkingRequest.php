<?php


namespace App\DTO\Request;


use App\DTO\Response\PeerMarkingDTO;
use JsonMapper;

class PeerMarkingRequest
{
    /** @var int */
    public $reviewId;

    /** @var array */
    public $marking;

    public function extractMarkingData()
    {

        $markings = $this->marking;
        $mapper = new JsonMapper();
        $markingArray = $mapper->mapArray($markings, array(), PeerMarkingDTO::class);
        $this->marking = $markingArray;

        return $this;
    }
}
