<?php


namespace App\Repository;


use App\DTO\Request\SelectTopicRequest;
use App\Models\StudentTopic;
use Illuminate\Database\Connection;
//use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Support\Facades\DB;

class StudentTopicRepository extends BaseRepository
{

    /**
     * StudentTopicRepository constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
    }

    public function createStudentTopic(SelectTopicRequest $request, $studentId)
    {
        $studentTopic = StudentTopic::create([
            'TOPIC_ID' => $request->topicId,
            'STUDENT_ID' => $studentId,
        ]);

        return $studentTopic->id;
    }

    public function findByTopics($topics)
    {
        $studentTopics = StudentTopic::whereIn('TOPIC_ID', $topics)->orderBy('TOPIC_ID')->get();

        $studentTopicsMap = array();
        foreach ($studentTopics as $st)
        {
            $studentTopicsMap[$st->STUDENT_ID] = $st->TOPIC_ID;
        }
        return $studentTopicsMap;
    }

    public function getTopicAllocationsByAssignment($assignmentId, $studentId)
    {
        $studentTopic = StudentTopic::select('TOPIC.TOPIC_NAME')
            ->join('TOPIC', 'TOPIC.TOPIC_ID', 'STUDENT_TOPIC.TOPIC_ID')
            ->where('TOPIC.ASSIGNMENT_ID', $assignmentId)
            ->where('STUDENT_TOPIC.STUDENT_ID', $studentId)->get();

        if (sizeof($studentTopic) == 0)
        {
            return "";
        }
        return $studentTopic[0]['TOPIC_NAME'];
    }

    public function getTopicAllocationAndCount($assignmentId, $studentId)
    {
        $studentTopic = DB::table('STUDENT_TOPIC')
            ->select(DB::raw(
            "CONCAT(COUNT(STUDENT_TOPIC.TOPIC_ID), '/', TOPIC.NUM_OF_STUDENTS) as numSelected"), 'TOPIC.TOPIC_NAME as name')
            ->join('TOPIC', 'TOPIC.TOPIC_ID', 'STUDENT_TOPIC.TOPIC_ID')
            ->where('STUDENT_TOPIC.TOPIC_ID', function ($query) use ($assignmentId, $studentId) {
                $query->select('TOPIC.TOPIC_ID')->from('STUDENT_TOPIC')
                    ->join('TOPIC', 'TOPIC.TOPIC_ID', 'STUDENT_TOPIC.TOPIC_ID')
                    ->where('TOPIC.ASSIGNMENT_ID', $assignmentId)
                    ->where('STUDENT_TOPIC.STUDENT_ID', $studentId);
            })->groupBy('STUDENT_TOPIC.TOPIC_ID')->get();

        if (sizeof($studentTopic) == 0)
        {
            return "";
        }
        return $studentTopic[0];
    }
}
