<?php


namespace App\DTO;


class LecturerUnitsResponseDTO
{

    /** @var string */
    public $unitCode;

    /** @var string */
    public $unitName;

    public function __construct($unit)
    {
        $this->unitCode = $unit['UNIT_CODE'];
        $this->unitName = $unit['UNIT_NAME'];
    }
}
