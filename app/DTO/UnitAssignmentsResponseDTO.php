<?php


namespace App\DTO;


class UnitAssignmentsResponseDTO
{

    /** @var int */
    public $id;

    /** @var string */
    public $title;

    /** @var string */
    public $dueDate;

    public function __construct($assignment)
    {
        $this->id = $assignment['ASSIGNMENT_ID'];
        $this->title = $assignment['TITLE'];
        $this->dueDate= $assignment['TOPIC_SELECTION_DEADLINE'];
    }
}
