<?php

namespace App\Http\Controllers;

use App\DTO\Request\AddTopicToAssignmentRequest;
use App\DTO\Request\AllocatePeersForReviewRequest;
use App\DTO\Request\AssignmentDeadlinesUpdateRequest;
use App\DTO\Request\AssignmentInfoUpdateRequest;
use App\DTO\Request\AssignmentMarkingCriteriaUpdateRequest;
use App\DTO\Request\CreateAssignmentRequest;
use App\Service\AssignmentService;
use App\Utility\Encryption;
use App\Utility\Utility;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonMapper;
use JsonMapper_Exception;
use function response;

class AssignmentController extends Controller
{
    /**
     * @param Request $request
     * @param AssignmentService $assignmentService
     * @return JsonResponse
     * @throws JsonMapper_Exception
     */
    public function createAssignment(Request $request, AssignmentService $assignmentService)
    {
        $token = Utility::GetTokenFromRequest($request);
        if (Encryption::ValidateLoginToken($token, Utility::LECTURER_USER_TYPE))
        {
            $data = json_decode($request->getContent());
            $mapper = new JsonMapper();
            $assignmentRequest = $mapper->map($data, new CreateAssignmentRequest());
            $assignmentRequest =
                $assignmentRequest->extractTopicSpecificationData()->extractMarkingCriteriaData()->extractFeedBackCriteriaData();

            return response()->json($assignmentService->createAssignment($assignmentRequest),200);
        }
        else
        {
            return Utility::NotAuthorisedError();
        }
    }

    /**
     * @param Request $request
     * @param $assignmentId
     * @param AssignmentService $assignmentService
     * @return JsonResponse
     * @throws JsonMapper_Exception
     */
    public function retrieveAssignment(Request $request, $assignmentId, AssignmentService $assignmentService)
    {
        $token = Utility::GetTokenFromRequest($request);
        if (Encryption::ValidateLoginToken($token, Utility::LECTURER_USER_TYPE))
        {
            return response()->json($assignmentService->retrieveAssignment($assignmentId),200);
        }
        else
        {
            return Utility::NotAuthorisedError();
        }
    }

    /**
     * @param Request $request
     * @param $assignmentId
     * @param AssignmentService $assignmentService
     * @return JsonResponse
     * @throws JsonMapper_Exception
     */
    public function retrieveAssignmentInfo(Request $request, $assignmentId, AssignmentService $assignmentService)
    {

        return response()->json($assignmentService->retrieveAssignmentBasicInfo($assignmentId),200);
    }

    /**
     * @param Request $request
     * @param $assignmentId
     * @param AssignmentService $assignmentService
     * @return JsonResponse
     */
    public function retrieveAssignmentDeadline(Request $request, $assignmentId, AssignmentService $assignmentService): JsonResponse
    {
        return response()->json($assignmentService->retrieveAssignmentDeadline($assignmentId),200);
    }

    /**
     * @param Request $request
     * @param $assignmentId
     * @param AssignmentService $assignmentService
     * @return JsonResponse
     * @throws JsonMapper_Exception
     */
    public function retrieveAssignmentTopics(Request $request, $assignmentId, AssignmentService $assignmentService)
    {
        return response()->json($assignmentService->retrieveAssignmentTopics($assignmentId),200);
    }

    /**
     * @param Request $request
     * @param $assignmentId
     * @param AssignmentService $assignmentService
     * @return JsonResponse
     * @throws JsonMapper_Exception
     */
    public function retrieveAssignmentMarkingCriteria(Request $request, $assignmentId,
                                                      AssignmentService $assignmentService)
    {
        return response()->json($assignmentService->retrieveAssignmentMarkingCriteria($assignmentId),200);
    }

    /**
     * @param Request $request
     * @param AssignmentService $assignmentService
     * @return JsonResponse
     * @throws JsonMapper_Exception
     */
    public function createAssignmentCriteria(Request $request, AssignmentService $assignmentService)
    {
        $token = Utility::GetTokenFromRequest($request);
        if (Encryption::ValidateLoginToken($token, Utility::LECTURER_USER_TYPE))
        {
            $data = (array)$request->getContent();
            $criteriaArray = [];
            //TODO
            /*foreach ($data['criteria'] as $criteria)
            {
                array_push($criteriaArray, new CriteriaDTO($criteria));
            }*/
            $assignmentService->createCriteriaForAssignment($criteriaArray, $data['assignmentId']);
            return response()->json([], 200);
        }
        else
        {
            return Utility::NotAuthorisedError();
        }
    }

    public function assignPeersForReview(Request $request, $assignmentId, AssignmentService $assignmentService)
    {
        $token = Utility::GetTokenFromRequest($request);
        if (Encryption::ValidateLoginToken($token, Utility::LECTURER_USER_TYPE))
        {
            $data = json_decode($request->getContent());
            $mapper = new JsonMapper();
            $allocatePeersRequest = $mapper->map($data, new AllocatePeersForReviewRequest());

            $assignmentService->allocatePeersToSubmission($allocatePeersRequest, $assignmentId);
            return response()->json([],200);
        }
        else
        {
            return Utility::NotAuthorisedError();
        }
    }

    /**
     * @param Request $request
     * @param $assignmentId
     * @param AssignmentService $assignmentService
     * @return JsonResponse
     * @throws JsonMapper_Exception
     */
    public function retrieveAssignmentTopicAllocation(Request $request, $assignmentId, AssignmentService $assignmentService): JsonResponse
    {
        return response()->json($assignmentService->retrieveAssignmentTopicAllocations($assignmentId),200);
    }

    /**
     * @param Request $request
     * @param $assignmentId
     * @param AssignmentService $assignmentService
     * @return JsonResponse
     * @throws JsonMapper_Exception
     */
    public function retrieveAssignmentPeers(Request $request, $assignmentId, AssignmentService $assignmentService)
    {
        $token = Utility::GetTokenFromRequest($request);
        if (Encryption::ValidateLoginToken($token, Utility::LECTURER_USER_TYPE))
        {
            return response()->json($assignmentService->retrieveAssignmentPeers($assignmentId),200);
        }
        else
        {
            return Utility::NotAuthorisedError();
        }
    }

    public function updateAssignmentPeers(Request $request, $assignmentId, AssignmentService $assignmentService)
    {
        $token = Utility::GetTokenFromRequest($request);
        if (Encryption::ValidateLoginToken($token, Utility::LECTURER_USER_TYPE))
        {
            $data = json_decode($request->getContent());
            $mapper = new JsonMapper();
            $updatePeers = $mapper->map($data, new AllocatePeersForReviewRequest());
            //TODO
            return response()->json($assignmentService->updateAssignmentPeers($updatePeers, $assignmentId),200);
        }
        else
        {
            return Utility::NotAuthorisedError();
        }
    }

    /**
     * @param Request $request
     * @param $assignmentId
     * @param AssignmentService $assignmentService
     * @return JsonResponse
     * @throws JsonMapper_Exception
     */
    public function updateAssignmentInfo(Request $request, $assignmentId, AssignmentService $assignmentService)
    {
        $token = Utility::GetTokenFromRequest($request);
        if (Encryption::ValidateLoginToken($token, Utility::LECTURER_USER_TYPE))
        {
            $data = json_decode($request->getContent());
            $mapper = new JsonMapper();
            $assignmentInfoUpdateRequest = $mapper->map($data, new AssignmentInfoUpdateRequest());
            return response()->json($assignmentService
                    ->updateAssignmentInfo($assignmentInfoUpdateRequest, $assignmentId),200);
        }
        else
        {
            return Utility::NotAuthorisedError();
        }
    }

    public function updateAssignmentTopics(Request $request, $assignmentId, AssignmentService $assignmentService)
    {
        $token = Utility::GetTokenFromRequest($request);
        if (Encryption::ValidateLoginToken($token, Utility::LECTURER_USER_TYPE))
        {
            $data = json_decode($request->getContent());
            $mapper = new JsonMapper();
            $updateAssignmentTopicsRequest = $mapper->map($data, new AddTopicToAssignmentRequest());
            $updateAssignmentTopicsRequest->setAssignmentId($assignmentId);
            $updateAssignmentTopicsRequest =
                $updateAssignmentTopicsRequest->extractTopicSpecificationData();

            return response()->json($assignmentService->createTopicsForAssignment($updateAssignmentTopicsRequest),200);
        }
        else
        {
            return Utility::NotAuthorisedError();
        }
    }

    /**
     * @param Request $request
     * @param $assignmentId
     * @param AssignmentService $assignmentService
     * @return JsonResponse
     * @throws JsonMapper_Exception
     */
    public function updateAssignmentMarkingCriteria(Request $request, $assignmentId, AssignmentService $assignmentService)
    {
        $token = Utility::GetTokenFromRequest($request);
        if (Encryption::ValidateLoginToken($token, Utility::LECTURER_USER_TYPE))
        {
            $data = json_decode($request->getContent());
            $mapper = new JsonMapper();
            $updateAssignmentMarkingCriteriaRequest = $mapper->map($data, new AssignmentMarkingCriteriaUpdateRequest());
            $updateAssignmentMarkingCriteriaRequest->extractMarkingCriteriaData()->extractFeedBackCriteriaData();

            return response()->json($assignmentService
                ->updateAssignmentMarkingCriteria($updateAssignmentMarkingCriteriaRequest, $assignmentId),200);
        }
        else
        {
            return Utility::NotAuthorisedError();
        }
    }

    /**
     * @param Request $request
     * @param $assignmentId
     * @param AssignmentService $assignmentService
     * @return JsonResponse
     * @throws JsonMapper_Exception
     */
    public function updateAssignmentDeadline(Request $request, $assignmentId, AssignmentService $assignmentService)
    {
        $token = Utility::GetTokenFromRequest($request);
        if (Encryption::ValidateLoginToken($token, Utility::LECTURER_USER_TYPE))
        {
            $data = json_decode($request->getContent());
            $mapper = new JsonMapper();
            $updateDeadlineRequest = $mapper->map($data, new AssignmentDeadlinesUpdateRequest());
            return response()->json($assignmentService
                ->updateAssignmentDeadline($updateDeadlineRequest,$assignmentId),200);
        }
        else
        {
            return Utility::NotAuthorisedError();
        }
    }
}
