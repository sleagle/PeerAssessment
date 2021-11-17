<?php


namespace App\Repository;


use App\DTO\MarkingCriteriaDTO;
use App\Models\Criteria;
use Illuminate\Database\Connection;

class CriteriaRepository extends BaseRepository
{
    /**
     * CriteriaRepository constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
    }

    /**
     * @param MarkingCriteriaDTO $data
     * @param int $assignmentId
     * @return int id of the newly created criteria
     */
    public function saveCriteria(MarkingCriteriaDTO $data, int $assignmentId): int
    {
        $criteriaId = Criteria::create([
            'CRITERIA_NAME' => $data->description,
            'CRITERIA_MARKS' => $data->mark,
            'HD_CRITERIA_DESC' => $data->hdCriteria->description,
            'DN_CRITERIA_DESC' => $data->dnCriteria->description,
            'CR_CRITERIA_DESC' => $data->crCriteria->description,
            'PP_CRITERIA_DESC' => $data->ppCriteria->description,
            'NN_CRITERIA_DESC' => $data->nnDescription,
            'ASSIGNMENT_ID' => $assignmentId,
            'CONTAIN_SUB_CATEGORY' => $data->containSubCategory,
        ]);

        return $criteriaId->id;
    }

    public function getCriteriaByAssignmentId($assignmentId)
    {
        return Criteria::where('ASSIGNMENT_ID', $assignmentId)->get();
    }
}
