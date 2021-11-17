<?php


namespace App\DTO;


use JsonMapper;
use JsonMapper_Exception;

class TopicAllocationResponseDTO
{
    /**  @var int */
    public $rowNum;

    /**  @var string */
    public $studentName;

    /**  @var int */
    public $studentId;

    /**  @var string */
    public $topic;

    /**  @var string */
    public $numSelected;

    /**
     * TopicAllocationResponseDTO constructor.
     * @param int $studentId
     * @param string $studentName
     * @param $topic
     * @param int $rowNum
     * @throws JsonMapper_Exception
     */
    public function __construct(int $studentId,  string $studentName, $topic, int $rowNum)
    {
        $data = json_encode((object)$topic);
        $mapper = new JsonMapper();
        $selectedTopicDetails = $mapper->map(json_decode($data), new SelectedTopicDetails());

        $this->rowNum = $rowNum;
        $this->studentName = $studentName;
        $this->studentId = $studentId;
        $this->topic = $selectedTopicDetails->name;
        $this->numSelected = $selectedTopicDetails->numSelected;
    }
}
