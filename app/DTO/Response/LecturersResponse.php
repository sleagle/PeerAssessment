<?php


namespace App\DTO\Response;


class LecturersResponse
{
    /** @var array */
    public $lecturers;

    /**
     * LecturersResponse constructor.
     * @param array $lecturers
     */
    public function __construct(array $lecturers)
    {
        $this->lecturers = $lecturers;
    }
}
