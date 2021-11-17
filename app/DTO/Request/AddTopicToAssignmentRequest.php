<?php


namespace App\DTO\Request;


use App\DTO\TopicSpecificationDTO;

class AddTopicToAssignmentRequest
{
    /** @var int */
    public $assignmentId;

    /** @var array */
    public $topicSpecification;

    /**
     * @param int $assignmentId
     */
    public function setAssignmentId(int $assignmentId): void
    {
        $this->assignmentId = $assignmentId;
    }

    /**
     * @param array $topicList
     */
    public function setTopicSpecification(array $topicList): void
    {
        $this->topicSpecification = $topicList;
    }

    public function extractTopicSpecificationData()
    {

        $topics = $this->topicSpecification;
        $mapper = new \JsonMapper();
        $topicSpecificationArray = $mapper->mapArray($topics, array(), TopicSpecificationDTO::class);
        $this->topicSpecification = $topicSpecificationArray;

        return $this;
    }
}
