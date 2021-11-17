<?php


namespace App\DTO;


class TopicSpecificationResponseDTO
{
    /**
     * @var int
     */
    public $topicId;

    /**
     * @var string
     */
    public $title;

    /**
     * @var integer
     */
    public $numStudents;

    /**
     * @var int
     */
    public $numSelected;

    /**  @var int */
    public $rowNum;

    /**
     * TopicSpecificationDTO constructor.
     * @param $topic
     * @param int $rowNum
     */
    public function __construct($topic, $rowNum=0)
    {
        $this->rowNum = $rowNum;
        $this->topicId = $topic['TOPIC_ID'];
        $this->title = $topic['TOPIC_NAME'];
        $this->numStudents = $topic['NUM_OF_STUDENTS'];
        $this->numSelected = $topic['NUM_SELECTED'];
    }


}
