<?php


namespace App\Service;

use App\DTO\CriteriaDTO;
use App\DTO\MarkingCriteriaDTO;
use App\DTO\Request\AddTopicToAssignmentRequest;
use App\DTO\Request\AllocatePeersForReviewRequest;
use App\DTO\Request\AssignmentDeadlinesUpdateRequest;
use App\DTO\Request\AssignmentInfoUpdateRequest;
use App\DTO\Request\AssignmentMarkingCriteriaUpdateRequest;
use App\DTO\Request\CreateAssignmentRequest;
use App\DTO\Request\FeedbackCriteriaDTO;
use App\DTO\Response\AssignmentDeadlinesResponse;
use App\DTO\Response\AssignmentDetailResponse;
use App\DTO\Response\AssignmentMarkingSchemeResponse;
use App\DTO\Response\AssignmentPeersResponse;
use App\DTO\Response\AssignmentTopicAllocationResponse;
use App\DTO\Response\AssignmentTopicsResponse;
use App\DTO\Response\BasicAssignmentInfoResponse;
use App\DTO\Response\UnitAssignmentsResponse;
use App\DTO\PassedUnitAssignmentsResponseDTO;
use App\DTO\SubCriteriaDTO;
use App\DTO\SubmissionsDTO;
use App\DTO\TopicAllocationResponseDTO;
use App\DTO\TopicSpecificationResponseDTO;
use App\DTO\UnitAssignmentsResponseDTO;
use App\Exceptions\PeerAssessmentException;
use App\Repository\AssignmentRepository;
use App\Repository\CriteriaRepository;
use App\Repository\FeedbackCriteriaRepository;
use App\Repository\ReviewRepository;
use App\Repository\StudentTopicRepository;
use App\Repository\SubCriteriaRepository;
use App\Repository\SubmissionRepository;
use App\Repository\TopicRepository;
use App\Repository\UnitRepository;
use App\Utility\Utility;
use Ds\Set;
use JsonMapper_Exception;

/**
 *
 * Class AssignmentService
 * @package App\Service
 *
 */
class AssignmentService
{

    private $assignmentRepository;

    private $topicRepository;

    private $criteriaRepository;

    private $subCriteriaRepository;

    private $feedbackCriteriaRepository;

    private $submissionRepository;

    private $reviewRepository;

    private $studentTopicRepository;

    private $unitRepository;

    public function __construct(AssignmentRepository $assignmentRepository, TopicRepository $topicRepository,
                                CriteriaRepository $criteriaRepository, SubCriteriaRepository $subCriteriaRepository,
                                FeedbackCriteriaRepository $feedbackCriteriaRepository,
                                SubmissionRepository $submissionRepository, ReviewRepository $reviewRepository,
                                StudentTopicRepository $studentTopicRepository, UnitRepository $unitRepository)
    {
        $this->assignmentRepository = $assignmentRepository;
        $this->topicRepository = $topicRepository;
        $this->criteriaRepository = $criteriaRepository;
        $this->subCriteriaRepository = $subCriteriaRepository;
        $this->feedbackCriteriaRepository = $feedbackCriteriaRepository;
        $this->submissionRepository = $submissionRepository;
        $this->reviewRepository = $reviewRepository;
        $this->studentTopicRepository = $studentTopicRepository;
        $this->unitRepository = $unitRepository;
    }

    /**
     * @param CreateAssignmentRequest $data
     * @return mixed
     */
    public function createAssignment(CreateAssignmentRequest $data)
    {

        $year = Utility::getYear();
        $semester = "Sem " . Utility::getSemester();

        $assignmentId = $this->assignmentRepository->createAssignment($data, $year, $semester);

        foreach ($data->topicSpecification as $topic)
        {
            $this->topicRepository->createTopic($topic, $assignmentId);
        }

        $this->createMarkingAndFeedbackCriteria($assignmentId, $data->markingCriteria, $data->feedbackCriteria);

        return $assignmentId;
    }

    /**
     * Retrieves an assignment for the given ID
     * @param int $assignmentId
     * @return AssignmentDetailResponse
     */
    public function retrieveAssignment(int $assignmentId): AssignmentDetailResponse
    {
        $assignmentTopics = [];
        $assignmentFeedbackCriteria = [];

        $assignmentDetails = $this->assignmentRepository->getAssignmentById($assignmentId);
        $assignmentResponse = new AssignmentDetailResponse($assignmentDetails[0]);

        $topics = $this->topicRepository->getTopicDetailsByAssignmentId($assignmentResponse->assignmentId);
        foreach ($topics as $topic)
        {
            array_push($assignmentTopics, new TopicSpecificationResponseDTO($topic));
        }

        $assignmentResponse->setTopicSpecification($assignmentTopics);

        $feedbackCriteria = $this->feedbackCriteriaRepository->retrieveDetailsFromAssignmentId($assignmentResponse->assignmentId);
        foreach ($feedbackCriteria as $feedbackCriterion) {
            array_push($assignmentFeedbackCriteria, new FeedbackCriteriaDTO($feedbackCriterion));
        }
        $assignmentResponse->setFeedbackCriteria($assignmentFeedbackCriteria);

        $assignmentResponse->setMarkingCriteria($this->populateMarkingCriteriaField($assignmentResponse->assignmentId));

        return $assignmentResponse;
    }

    /**
     * Retrieves an assignment for the given ID
     * @param int $assignmentId
     * @return BasicAssignmentInfoResponse
     */
    public function retrieveAssignmentBasicInfo(int $assignmentId): BasicAssignmentInfoResponse
    {

        $assignmentDetails = $this->assignmentRepository->getBasicAssignmentInfoById($assignmentId);
        $unitDetails = $this->unitRepository->getUnitByUnitCode($assignmentDetails[0]['UNIT_CODE']);

        return new BasicAssignmentInfoResponse($assignmentDetails[0], $unitDetails[0]);
    }

    public function retrieveAssignmentTopics(int $assignmentId): AssignmentTopicsResponse
    {
        $topics = $this->topicRepository->getTopicDetailsByAssignmentId($assignmentId);
        $unitCode = $this->assignmentRepository->getUnitCodeById($assignmentId);
        $assignmentTopics = [];
        $count = 1;
        foreach ($topics as $topic)
        {
            array_push($assignmentTopics, new TopicSpecificationResponseDTO($topic, $count++));
        }

        return new AssignmentTopicsResponse($unitCode[0], $assignmentTopics);
    }

    /**
     * @param int $assignmentId
     * @return AssignmentTopicAllocationResponse
     * @throws JsonMapper_Exception
     */
    public function retrieveAssignmentTopicAllocations(int $assignmentId): AssignmentTopicAllocationResponse
    {
        $unitCode = $this->assignmentRepository->getUnitCodeById($assignmentId)[0]['UNIT_CODE'];
        $students =
            $this->unitRepository->getStudentNamesAndIdsInEnrollment($unitCode, Utility::getYear(),
                Utility::getSemester());

        $topicAllocations = [];
        $count = 1;

        foreach ($students as $student)
        {
            $studentId = $student['STUDENT_ID'];
            $topicDetails = $this->studentTopicRepository->getTopicAllocationAndCount($assignmentId, $studentId);
            array_push($topicAllocations, new TopicAllocationResponseDTO($studentId, $student['NAME'],
                $topicDetails, $count++));
        }

        return new AssignmentTopicAllocationResponse($unitCode, $topicAllocations);
    }

    public function retrieveAssignmentMarkingCriteria(int $assignmentId): AssignmentMarkingSchemeResponse
    {
        $unitCode = $this->assignmentRepository->getUnitCodeById($assignmentId);
        $feedbackCriteria = $this->feedbackCriteriaRepository->retrieveDetailsFromAssignmentId($assignmentId);

        $assignmentFeedbackCriteria =[];
        foreach ($feedbackCriteria as $feedbackCriterion) {
            array_push($assignmentFeedbackCriteria, new FeedbackCriteriaDTO($feedbackCriterion));
        }

        $markingSchemeResponse = new AssignmentMarkingSchemeResponse($unitCode[0]);
        $markingSchemeResponse->setFeedbackCriteria($assignmentFeedbackCriteria);
        $markingSchemeResponse->setMarkingCriteria($this->populateMarkingCriteriaField($assignmentId));

        return $markingSchemeResponse;
    }

    public function retrieveAssignmentDeadline(int $assignmentId): AssignmentDeadlinesResponse
    {

        $assignmentDeadlineDetails = $this->assignmentRepository->getBasicAssignmentDeadlinesById($assignmentId);

        return new AssignmentDeadlinesResponse($assignmentDeadlineDetails[0]);
    }

    public function retrieveUnitCodeFromAssignment(int $assignmentId)
    {
        return $this->assignmentRepository->getUnitCodeById($assignmentId)[0]['UNIT_CODE'];
    }
    /**
     * @param $data
     * @param int $assignmentId
     */

    public function createCriteriaForAssignment($data, int $assignmentId)
    {
        foreach ($data as $criteria)
        {
            $this->criteriaRepository->saveCriteria($criteria, $assignmentId);
        }
    }

    /**
     * @param string $unitId
     * @return mixed
     * @throws PeerAssessmentException
     */
    public function getAssignmentsByUnit(string $unitId): UnitAssignmentsResponse
    {
        $currentAssignments = [];
        $pastAssignments =[];
        $currentAssignmentIds = [];
        $sem = "Sem " . Utility::getSemester();
        $current = $this->assignmentRepository->getCurrentAssignmentsByUnitCode($unitId, $sem, Utility::getYear());

        foreach ($current as $assignment)
        {
            array_push($currentAssignments, new UnitAssignmentsResponseDTO($assignment));
            array_push($currentAssignmentIds, $assignment['ASSIGNMENT_ID']);
        }

        $past = $this->assignmentRepository->getPastAssignmentsByUnitCode($unitId,$currentAssignmentIds);
        foreach ($past as $assignment) {
            array_push($pastAssignments, new PassedUnitAssignmentsResponseDTO($assignment));
        }

        return new UnitAssignmentsResponse($currentAssignments, $pastAssignments);
    }

    /**
     * @param string $unitId
     * @return mixed
     * @throws PeerAssessmentException
     */
    public function getAssignmentOfferingsByUnit(string $unitId): array
    {
        $offerings =[];
        $currentOffering = 'Sem ' . Utility::getSemester() . ' - ' . Utility::getYear();
        $dataSet = $this->assignmentRepository->getAssignmentOfferingsByUnit($unitId, $currentOffering);
        foreach ($dataSet as $data) {
            array_push($offerings, $data['OFFERING']);
        }
        return $offerings;
    }

    public function retrieveAssignmentPeers($assignmentId): AssignmentPeersResponse
    {
        $assignmentPeers = $this->assignmentRepository->retrieveAssignmentPeers($assignmentId);

        return new AssignmentPeersResponse($assignmentPeers);
    }

    public function allocatePeersToSubmission(AllocatePeersForReviewRequest $request, $assignmentId)
    {
        $numOfPeers = $request->numPeers;

        if ($request->allocationStrategy == 1)
        {
            $submissionReviews = $this->allocatePeersWithoutStudentIntersection($assignmentId, $numOfPeers);
        }
        else
        {
            $submissionReviews = $this->allocatePeersWithoutTopicIntersection($assignmentId);
        }

        foreach ($submissionReviews as $key => $reviews) {
            foreach ($reviews as $review) {
                $this->reviewRepository->createReview($key, $review);
            }
        }
    }

    public function createTopicsForAssignment(AddTopicToAssignmentRequest $request): AssignmentTopicsResponse
    {
        foreach ($request->topicSpecification as $topic)
        {
            if ($this->topicRepository->findTopicByAssignmentIdAndName($request->assignmentId, $topic->title) == 0) {
                $this->topicRepository->createTopic($topic, $request->assignmentId);
            }
        }
        return $this->retrieveAssignmentTopics($request->assignmentId);
    }

    public function updateAssignmentPeers(AllocatePeersForReviewRequest $request, $assignmentId)
    {
        //TODO
        return 0;
    }

    public function updateAssignmentInfo(AssignmentInfoUpdateRequest $request, $assignmentId): int
    {
        return $this->assignmentRepository->updateAssignmentInfo($request, $assignmentId);
    }

    public function updateAssignmentMarkingCriteria(AssignmentMarkingCriteriaUpdateRequest $request, $assignmentId): int
    {
        $this->createMarkingAndFeedbackCriteria($assignmentId, $request->markingCriteria, $request->feedbackCriteria);

        return 0;
    }

    public function updateAssignmentDeadline(AssignmentDeadlinesUpdateRequest $request, $assignmentId): int
    {
        return $this->assignmentRepository->updateAssignmentDeadline($request, $assignmentId);
    }

    /**
     * @param string $unitCode
     * @param string $studentId
     * @return UnitAssignmentsResponse
     * @throws PeerAssessmentException
     */
    public function getStudentAssignmentsByUnitCode(string $unitCode, string $studentId): UnitAssignmentsResponse
    {
        $currentAssignments = [];
        $pastAssignments =[];
        $currentAssignmentIds = [];
        $current = $this->assignmentRepository
            ->getCurrentStudentAssignmentsByUnitCode($unitCode, $studentId,Utility::getSemester(), Utility::getYear());

        foreach ($current as $assignment)
        {
            array_push($currentAssignments, new UnitAssignmentsResponseDTO($assignment));
            array_push($currentAssignmentIds, $assignment['ASSIGNMENT_ID']);
        }

        $past = $this->assignmentRepository
            ->getStudentPastAssignmentByUnit($unitCode, $studentId,$currentAssignmentIds,Utility::getSemester(), Utility::getYear());
        foreach ($past as $assignment) {
            array_push($pastAssignments, new PassedUnitAssignmentsResponseDTO($assignment));
        }

        return new UnitAssignmentsResponse($currentAssignments, $pastAssignments);
    }

    private function createMarkingAndFeedbackCriteria($assignmentId, array $markingCriteria,
                                                      array $feedbackCriteria)
    {
        foreach ($markingCriteria as $criteria)
        {
            $criteriaId = $this->criteriaRepository->saveCriteria($criteria, $assignmentId);

            if ($criteria->containSubCategory)
            {
                if (count($criteria->hdCriteria->subCriteria) > 0)
                {
                    foreach ($criteria->hdCriteria->subCriteria as $subCriterion)
                    {
                        $this->subCriteriaRepository->saveSubCriteria($subCriterion, $criteriaId, "HD");
                    }
                }

                if (count($criteria->dnCriteria->subCriteria) > 0)
                {
                    foreach ($criteria->dnCriteria->subCriteria as $subCriterion)
                    {
                        $this->subCriteriaRepository->saveSubCriteria($subCriterion, $criteriaId, "DN");
                    }
                }

                if (count($criteria->crCriteria->subCriteria) > 0)
                {
                    foreach ($criteria->crCriteria->subCriteria as $subCriterion)
                    {
                        $this->subCriteriaRepository->saveSubCriteria($subCriterion, $criteriaId, "CR");
                    }
                }

                if (count($criteria->ppCriteria->subCriteria) > 0)
                {
                    foreach ($criteria->ppCriteria->subCriteria as $subCriterion)
                    {
                        $this->subCriteriaRepository->saveSubCriteria($subCriterion, $criteriaId, "PP");
                    }
                }
            }
        }

        if (!is_null($feedbackCriteria)) {
            foreach ($feedbackCriteria as $feedbackCriterion)
            {
                $this->feedbackCriteriaRepository->createFeedbackCriteria($feedbackCriterion, $assignmentId);
            }

        }
    }

    private function populateMarkingCriteriaField($assignmentId)
    {
        $assignmentCriteria = [];
        $criteria = $this->criteriaRepository->getCriteriaByAssignmentId($assignmentId);

        foreach ($criteria as $criterion)
        {
            $hdSubCriteria = [];
            $dnSubCriteria = [];
            $crSubCriteria = [];
            $ppSubCriteria = [];

            if ($criterion['CONTAIN_SUB_CATEGORY'] == 1)
            {
                $subCriteriaList = $this->subCriteriaRepository->getSubCriteriaByCriteriaId($criterion['CRITERIA_ID']);
                foreach ($subCriteriaList as $subCriteria)
                {
                    switch ($subCriteria['SUB_CRITERIA_TYPE'])
                    {
                        case "HD":
                            array_push($hdSubCriteria, new SubCriteriaDTO($subCriteria));
                            break;
                        case "DN":
                            array_push($dnSubCriteria, new SubCriteriaDTO($subCriteria));
                            break;
                        case "CR":
                            array_push($crSubCriteria, new SubCriteriaDTO($subCriteria));
                            break;
                        case "PP":
                            array_push($ppSubCriteria, new SubCriteriaDTO($subCriteria));
                            break;
                    }
                }
            }
            array_push($assignmentCriteria, new MarkingCriteriaDTO($criterion,
                new CriteriaDTO($criterion['HD_CRITERIA_DESC'], $hdSubCriteria),
                new CriteriaDTO($criterion['DN_CRITERIA_DESC'], $dnSubCriteria),
                new CriteriaDTO($criterion['CR_CRITERIA_DESC'], $crSubCriteria),
                new CriteriaDTO($criterion['PP_CRITERIA_DESC'], $ppSubCriteria)));
        }

        return $assignmentCriteria;
    }

    private function allocatePeersWithoutStudentIntersection(int $assignmentId, int $numOfPeers)
    {
        $submissions = $this->submissionRepository->findSubmissionsFromAssignment($assignmentId);
        $submissionArray = $this->populateSubmissionsArray($submissions);

        $submissionSplit = array_chunk($submissionArray, count($submissionArray)/($numOfPeers+1));
        return $this->populateReviewCollection(count($submissionSplit), $submissionSplit);
    }

    private function allocatePeersWithoutTopicIntersection(int $assignmentId)
    {
        $assignmentTopicSubmissions = [];
        $assignmentTopics = $this->topicRepository->getByAssignmentId($assignmentId);
        $topicLoc = 0;
        foreach ($assignmentTopics as $assignmentTopic)
        {
            $topicSubmissions = $this->submissionRepository->retrieveSubmissionsPerTopic($assignmentTopic['TOPIC_ID']);
            $assignmentTopicSubmissions[$topicLoc++] =
                $this->populateSubmissionsArray($topicSubmissions);
        }
        return $this->populateReviewCollection(count($assignmentTopicSubmissions), $assignmentTopicSubmissions);
    }

    private function populateSubmissionsArray($submissions)
    {
        $submissionArray = array();

        foreach ($submissions as $submission)
        {
            array_push($submissionArray, new SubmissionsDTO($submission));
        }

        shuffle($submissionArray);
        return $submissionArray;
    }

    private function populateReviewCollection($sizeOfSplit, $submission)
    {
        $submissionReviews = [];
        for ($i = 0; $i < $sizeOfSplit; $i++)
        {
            $submissionSet = $submission[$i];
            for ($y = 0; $y < count($submissionSet); $y++)
            {
                $set = new Set();
                $submissionObj = $submissionSet[$y];
                for ($x = 0; $x < $sizeOfSplit; $x++)
                {
                    if ($x != $i) {
                        $set->add($submission[$x][$y]->studentId);
                    }
                }
                $submissionReviews[$submissionObj->submissionId] = $set;
            }
        }

        return $submissionReviews;
    }
}
