<?php

namespace App\Http\Controllers;

use App\DTO\Request\PeerFeedbackMarkingRequest;
use App\DTO\Request\PeerMarkingRequest;
use App\DTO\Request\SelectTopicRequest;
use App\DTO\Request\SubmitAssignmentRequest;
use App\Exceptions\PeerAssessmentException;
use App\Service\AssignmentService;
use App\Service\ReviewService;
use App\Service\StudentService;
use App\Service\UnitService;
use App\Service\UserService;
use App\Utility\Encryption;
use App\Utility\Utility;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonMapper;
use JsonMapper_Exception;
use SodiumException;

use function response;

class StudentController extends Controller
{

    /**
     * @param Request $request
     * @param UnitService $unitService
     * @return JsonResponse
     * @throws JsonMapper_Exception | SodiumException
     */
    public function getStudentUnits(Request $request, UnitService $unitService): JsonResponse
    {
        $token = Utility::GetTokenFromRequest($request);

        return response()->json($unitService->getStudentUnits(Encryption::GetUserID($token)), 200);
    }

    /**
     * @param Request $request
     * @param StudentService $studentService
     * @return bool|JsonResponse
     * @throws JsonMapper_Exception | SodiumException
     */
    public function selectTopicForAssignment(Request $request, StudentService $studentService)
    {
        $token = Utility::GetTokenFromRequest($request);

        $data = json_decode($request->getContent());
        $mapper = new JsonMapper();
        $selectTopicRequest = $mapper->map($data, new SelectTopicRequest());

        try
        {
            return response()->json($studentService
                ->selectTopic($selectTopicRequest, Encryption::GetUserID($token)),200);
        }
        catch (PeerAssessmentException $exception)
        {
            return response()->json($exception,400);
        }
        catch (QueryException $exception)
        {
            return $this->queryExceptionResponse($exception);
        }
    }

    /**
     * @param Request $request
     * @param StudentService $studentService
     * @return JsonResponse
     * @throws JsonMapper_Exception|SodiumException
     */
    public function submitAssignment(Request $request, StudentService $studentService): JsonResponse
    {
        $token = Utility::GetTokenFromRequest($request);

        $data = json_decode($request->getContent());
        $mapper = new JsonMapper();
        $submissionRequest = $mapper->map($data, new SubmitAssignmentRequest());

        try
        {
            return response()->json($studentService
                ->submitAssignment($submissionRequest, Encryption::GetUserID($token)),200);
        }
        catch (QueryException $exception)
        {
            return $this->queryExceptionResponse($exception);
        }
    }

    /**
     * @param Request $request
     * @param StudentService $studentService
     * @return JsonResponse
     * @throws JsonMapper_Exception|SodiumException
     */
    public function peerReviewSubmission(Request $request, StudentService $studentService): JsonResponse
    {
        $token = Utility::GetTokenFromRequest($request);

        $data = json_decode($request->getContent());
        $mapper = new JsonMapper();
        $submissionRequest = $mapper->map($data, new SubmitAssignmentRequest());

        try
        {
            $reviews = $studentService->peerReviewSubmission();
            echo $reviews;
            return response()->json(2,200);
        }
        catch (QueryException $exception)
        {
            return $this->queryExceptionResponse($exception);
        }
    }

    /**
     * @param Request $request
     * @param StudentService $studentService
     * @return JsonResponse
     */
    public function provideFeedbackOnReview(Request $request, StudentService $studentService): JsonResponse
    {
        //TODO
        return response()->json([],200);
    }

    /**
     * @param Request $request
     * @param AssignmentService $assignmentService
     * @param $unitCode
     * @return JsonResponse
     */
    public function getStudentAssignmentsByUnit(Request $request, AssignmentService $assignmentService, $unitCode): JsonResponse
    {
        $token = Utility::GetTokenFromRequest($request);
        try {
            return response()->json(
                $assignmentService->getStudentAssignmentsByUnitCode($unitCode, Encryption::GetUserID($token)), 200);
        } catch (Exception $e) {

        }
    }

    public function getStudentPastEnrollmentsByUnit(Request $request, UserService $userService, $unitCode): JsonResponse
    {
        $token = Utility::GetTokenFromRequest($request);
        try {
            return response()->json(
                $userService->getStudentPastEnrollmentsByUnit($unitCode, Encryption::GetUserID($token)), 200);
        } catch (Exception $e) {

        }
    }

    public function getSubmissionReviewsForFeedback(Request $request, ReviewService $reviewService, $assignmentId): JsonResponse
    {
        $token = Utility::GetTokenFromRequest($request);
        try {
            return response()->json(
                $reviewService->getReviewsForFeedbackFromSubmission(Encryption::GetUserID($token), $assignmentId), 200);
        } catch (Exception $e) {

        }
    }

    public function getAssignmentReviewsToMake(Request $request, ReviewService $reviewService, $assignmentId): JsonResponse
    {
        $token = Utility::GetTokenFromRequest($request);
        try {
            return response()->json(
                $reviewService->getReviewsToMakeFromAssignment(Encryption::GetUserID($token), $assignmentId), 200);
        } catch (Exception $e) {

        }
    }

    public function createAssignmentReview(Request $request, ReviewService $reviewService): JsonResponse
    {
        $data = json_decode($request->getContent());
        $mapper = new JsonMapper();
        $peerMarkingRequest = $mapper->map($data, new PeerMarkingRequest());
        $peerMarkingRequest =
            $peerMarkingRequest->extractMarkingData();

        return response()->json($reviewService->createPeerReview($peerMarkingRequest),200);
    }

    public function createAssignmentFeedbackReview(Request $request, ReviewService $reviewService): JsonResponse
    {
        $data = json_decode($request->getContent());
        $mapper = new JsonMapper();
        $peerFeedbackMarkingRequest = $mapper->map($data, new PeerFeedbackMarkingRequest());

        return response()->json($reviewService->createPeerFeedReview($peerFeedbackMarkingRequest),200);
    }

    public function enrolInTopic(Request $request, StudentService $studentService): JsonResponse
    {
        $data = $request->input('topicId');

        return response()->json("hi",200);
    }

    public function unenrollFromTopic(Request $request, StudentService $studentService): JsonResponse
    {
        $data = $request->input('topicId');

        return response()->json("hi",200);
    }

    /**
     * @param $exception
     * @return JsonResponse
     */
    private function queryExceptionResponse($exception): JsonResponse
    {
        $passException = new PeerAssessmentException();
        $passException->setCode($exception->getCode());
        $passException->setMessage($exception->getMessage());

        return response()->json($passException,400);
    }
}
