<?php


namespace App\DTO;


class CriteriaDTO
{

    /**
     * @var string
     */
    public $description;

    /**
     * @var array
     */
    public $subCriteria;

    /**
     * CriteriaDTO constructor.
     * @param string $description
     * @param array $subCriteria
     */
    public function __construct(string $description, array $subCriteria)
    {
        $this->description = $description;
        $this->subCriteria = $subCriteria;
    }


}
