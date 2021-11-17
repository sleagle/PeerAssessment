<?php


namespace App\Repository;


use App\DTO\Request\FeedbackCriteriaDTO;
use App\Models\FeedbackCriteria;
use Illuminate\Database\Connection;

class FeedbackCriteriaRepository extends BaseRepository
{
    /**
     * FeedbackCriteriaRepository constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
    }

    /**
     * @param FeedbackCriteriaDTO $data
     * @param $assignmentId
     * @return int id of the feedback criteria
     */
    public function createFeedbackCriteria(FeedbackCriteriaDTO $data, $assignmentId): int
    {
        $feedbackCriteria = FeedbackCriteria::create([
            'CRITERIA_NAME' => $data->criteria,
            'CRITERIA_MARKS' => $data->marks,
            'HD_CRITERIA_DESC' => $data->hdCriteria,
            'DN_CRITERIA_DESC' => $data->dnCriteria,
            'CR_CRITERIA_DESC' => $data->crCriteria,
            'PP_CRITERIA_DESC' => $data->ppCriteria,
            'NN_CRITERIA_DESC' => $data->nnCriteria,
            'ASSIGNMENT_ID' => $assignmentId,
        ]);

        return $feedbackCriteria->id;
    }

    /**
     * @param $assignmentId
     * @return mixed
     */
    public function retrieveDetailsFromAssignmentId($assignmentId)
    {
        return FeedbackCriteria::where('ASSIGNMENT_ID', $assignmentId)->get();
    }
}
