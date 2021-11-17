<?php


namespace App\DTO\Response;


use function Symfony\Component\String\u;

class AssignmentTopicsResponse
{

    /** @var string */
    public $unitCode;

    /** @var array */
    public $topics;

    /**
     * AssignmentTopicsResponse constructor.
     * @param $unitCode
     * @param array $topics
     */
    public function __construct($unitCode, array $topics)
    {
        $this->unitCode = $unitCode['UNIT_CODE'];
        $this->topics = $topics;
    }
}
