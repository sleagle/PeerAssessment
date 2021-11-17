<?php


namespace App\DTO\Response;


class LecturerUnitsResponse
{

    /** @var array */
    public $units;

    /**
     * LecturerUnitsResponse constructor.
     * @param array $units
     */
    public function __construct(array $units)
    {
        $this->units = $units;
    }
}
