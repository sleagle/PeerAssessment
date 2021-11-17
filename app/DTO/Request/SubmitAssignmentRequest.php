<?php


namespace App\DTO\Request;


class SubmitAssignmentRequest
{

    /**
     * @var int
     */
    public $assignmentId;

    /**
     * @var string
     */
    public $fileLocation;

    /**
     * SubmitAssignmentRequest constructor.
     * @param int $assignmentId
     * @param string $fileLocation
     */
    public function __construct(int $assignmentId, string $fileLocation)
    {
        $this->assignmentId = $assignmentId;
        $this->fileLocation = $fileLocation;
    }


}
