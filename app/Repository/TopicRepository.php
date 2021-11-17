<?php


namespace App\Repository;


use App\Models\Topic;
use Illuminate\Database\Connection;

class TopicRepository extends BaseRepository
{
    /**
     * TopicRepository constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
    }

    /**
     * @param $data
     * @param int $assignmentId
     */
    public function createTopic($data, int $assignmentId)
    {
        Topic::create([
            'TOPIC_NAME' => $data->title,
            'NUM_OF_STUDENTS' => $data->numStudents,
            'ASSIGNMENT_ID' => $assignmentId,
            'NUM_SELECTED' => 0,
        ]);
    }

    public function findTopicByAssignmentIdAndName(int $assignmentId, string $name)
    {
        return Topic::where('ASSIGNMENT_ID', $assignmentId)->where('TOPIC_NAME', $name)->count();
    }

    /**
     * @param int $topicId
     * @return Topic
     */
    public function getById(int $topicId)
    {
        $topic = Topic::where('TOPIC_ID', $topicId);

        return $topic->first();
    }

    /**
     * @param int $topicId
     * @param int $numSelected
     */
    public function updateTopicNumSelection(int $topicId, int $numSelected)
    {
        Topic::where('TOPIC_ID', $topicId)
            ->update([
                'NUM_SELECTED' => $numSelected
            ]);
    }

    public function getTopicDetailsByAssignmentId(int $assignmentId)
    {
        $topics = Topic::where('ASSIGNMENT_ID', $assignmentId);

        return $topics->get();
    }

    public function getByAssignmentId(int $assignmentId)
    {
        $topics = Topic::select('TOPIC_ID')->where('ASSIGNMENT_ID', $assignmentId);

        return $topics->get();
    }

    public function getTopicStudentCountByAssignmentIds($assignmentTopicIss)
    {
        return Topic::select('NUM_OF_STUDENTS' )->whereIn('TOPIC_ID', $assignmentTopicIss)->distinct()->get();
    }
}
