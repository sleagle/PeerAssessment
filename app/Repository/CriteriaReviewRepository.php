<?php


namespace App\Repository;


use App\DTO\Response\PeerMarkingDTO;
use App\Models\CriteriaReview;
use Illuminate\Database\Connection;

class CriteriaReviewRepository extends BaseRepository
{
    /**
     * ReviewRepository constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
    }

    /**
     * @param int $reviewId
     * @param int $criteriaId
     * @return mixed
     */
    public function getCriteriaReviewByReviewId(int $reviewId, int $criteriaId)
    {
        return CriteriaReview::where('REVIEW_ID', $reviewId)
            ->where('CRITERIA_ID', $criteriaId)
            ->get();
    }

    public function createCriteriaReview(int $reviewId, PeerMarkingDTO $mark)
    {
        $criteriaReview = CriteriaReview::create([
            'CRITERIA_ID' => $mark->criteriaId,
            'REVIEW_ID' => $reviewId,
            'MARK' => $mark->mark,
            'COMMENT' => $mark->comment,
            'GRADE' => $mark->grade
        ]);

    }
}
