<?php


namespace App\Service;


use App\DTO\Request\SelectTopicRequest;
use App\DTO\Request\SubmitAssignmentRequest;
use App\Exception\PeerAssessmentException;
use App\Repository\StudentTopicRepository;
use App\Repository\SubmissionRepository;
use App\Repository\TopicRepository;

class StudentService
{
    private $studentTopicRepository;

    private $submissionRepository;

    private $topicRepository;

    /**
     * StudentService constructor.
     * @param StudentTopicRepository $studentTopicRepository
     * @param SubmissionRepository $submissionRepository
     * @param TopicRepository $topicRepository
     */
    public function __construct(StudentTopicRepository $studentTopicRepository, SubmissionRepository $submissionRepository,
                                TopicRepository $topicRepository)
    {
        $this->studentTopicRepository = $studentTopicRepository;
        $this->submissionRepository = $submissionRepository;
        $this->topicRepository = $topicRepository;
    }

    public function selectTopic(SelectTopicRequest $request, $studentId)
    {
        $topic = $this->topicRepository->getById($request->topicId);
        $numSelected = $topic->NUM_SELECTED;

        if ($numSelected == $topic->NUM_OF_STUDENTS)
        {
            $error = new PeerAssessmentException();
            $error->setCode("ERR005");
            $error->setMessage("This topic's quota is full. Please select another topic");

            throw $error;
        }
        else {
            $this->studentTopicRepository->createStudentTopic($request, $studentId);
            $numSelected++;
            $this->topicRepository->updateTopicNumSelection($request->topicId, $numSelected);

            return $request->topicId;
        }
    }

    public function submitAssignment(SubmitAssignmentRequest $request, $studentId): int
    {
        $existingSubmission = $this->submissionRepository->findByAssignmentAndStudentIds($request->assignmentId, $studentId);
        if (is_null($existingSubmission)) {
            return $this->submissionRepository->createSubmission($request, $studentId, date("Y-m-d H:i:s"));
        }
        else
        {
            return $this->submissionRepository->updateSubmission($existingSubmission, $request, date("Y-m-d H:i:s"));
        }
    }

    public function peerReviewSubmission()
    {
        return $this->submissionRepository->findSubmissionWithReviewsLessThanLimit(1, 3);
    }

    public function UnenrollFromTopic(int $topicId, $studentId)
    {
        $this->studentTopicRepository->createStudentTopic();
    }
}
