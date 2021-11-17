<?php


namespace App\Repository;


use App\DTO\SubCriteriaDTO;
use App\Models\SubCriteria;
use Illuminate\Database\Connection;

class SubCriteriaRepository extends BaseRepository
{
    /**
     * SubCriteriaRepository constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
    }

    /**
     * @param SubCriteriaDTO $data
     * @param $criteriaId
     * @param $criteriaType
     * @return int newly created record's id
     */
    public function saveSubCriteria(SubCriteriaDTO $data, $criteriaId, $criteriaType): int
    {
        $subCriteria = SubCriteria::create([
            'SUB_CRITERIA_TYPE'=> $criteriaType,
            'SUB_CRITERIA_DESC' => $data->description,
            'SUB_CRITERIA_MARKS' => $data->mark,
            'CRITERIA_ID' => $criteriaId,
        ]);

        return $subCriteria->id;
    }

    public function getSubCriteriaByCriteriaId($criteriaId)
    {
        return SubCriteria::where('CRITERIA_ID', $criteriaId)->get();
    }
}
