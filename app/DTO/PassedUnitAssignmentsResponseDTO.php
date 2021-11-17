<?php


namespace App\DTO;


class PassedUnitAssignmentsResponseDTO
{

    /** @var int */
    public $id;

    /** @var string */
    public $title;

    /** @var string */
    public $dueDate;

    /** @var string */
    public $yearNSemester;

    public function __construct($assignment)
    {
        $this->id = $assignment['ASSIGNMENT_ID'];
        $this->title = $assignment['TITLE'];
        $this->dueDate= $assignment['TOPIC_SELECTION_DEADLINE'];
        $this->yearNSemester = $assignment['SEMESTER'] . " - " . $assignment['YEAR'] ;
    }
}
