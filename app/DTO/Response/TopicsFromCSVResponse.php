<?php


namespace App\DTO\Response;


class TopicsFromCSVResponse
{

    /**  @var int */
    public $rowNum;

    /**
     * @var string
     */
    public $title;

    /**
     * @var integer
     */
    public $numStudents;

    /**
     * TopicsFromCSVResponse constructor.
     * @param $data
     * @param int $rowNum
     */
    public function __construct($data, int $rowNum)
    {
        $this->rowNum = $rowNum;
        $this->title = $data['topic'];
        $this->numStudents = $data['numStudents'];
    }
}
