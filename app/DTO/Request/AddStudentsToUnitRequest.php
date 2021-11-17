<?php


namespace App\DTO\Request;


class AddStudentsToUnitRequest
{
    /** @var string */
    public $unitCode;

    /** @var string */
    public $fileLocation;

    /**
     * @param string $unitCode
     */
    public function setUnitCode(string $unitCode): void
    {
        $this->unitCode = $unitCode;
    }

    /**
     * @param string $fileLocation
     */
    public function setFileLocation(string $fileLocation): void
    {
        $this->fileLocation = $fileLocation;
    }

}
