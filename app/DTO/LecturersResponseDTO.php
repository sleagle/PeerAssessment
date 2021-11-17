<?php


namespace App\DTO;


class LecturersResponseDTO
{

    /** @var int */
    public $lecturerId;

    /** @var string */
    public $lecturerName;

    /**
     * LecturersResponseDTO constructor.
     * @param int $lecturerId
     * @param string $lecturerName
     */
    public function __construct(int $lecturerId, string $lecturerName)
    {
        $this->lecturerId = $lecturerId;
        $this->lecturerName = $lecturerName;
    }

    /**
     * @return int
     */
    public function getLecturerId(): int
    {
        return $this->lecturerId;
    }

    /**
     * @param int $lecturerId
     */
    public function setLecturerId(int $lecturerId): void
    {
        $this->lecturerId = $lecturerId;
    }

    /**
     * @return string
     */
    public function getLecturerName(): string
    {
        return $this->lecturerName;
    }

    /**
     * @param string $lecturerName
     */
    public function setLecturerName(string $lecturerName): void
    {
        $this->lecturerName = $lecturerName;
    }
}
