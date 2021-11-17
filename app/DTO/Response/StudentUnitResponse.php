<?php


namespace App\DTO\Response;


class StudentUnitResponse
{
    /** @var string */
    public $unitCode;

    /** @var string */
    public $unitName;

    /**
     * StudentUnitResponse constructor.
     * @param $unit
     */
    public function __construct($unit)
    {
        $this->unitCode = $unit['UNIT_CODE'];
        $this->unitName = $unit['UNIT_NAME'];
    }
}
