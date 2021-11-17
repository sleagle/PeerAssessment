<?php

namespace App\Http\Controllers;

use App\DTO\Request\AddStudentsToUnitRequest;
use App\Exceptions\PeerAssessmentException;
use App\Service\AssignmentService;
use App\Service\UserService;
use App\Utility\Encryption;
use App\Utility\LoginToken;
use App\Utility\Utility;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonMapper;
use JsonMapper_Exception;
use function response;

class UnitController extends Controller
{
    /**
     * @param Request $request
     * @param AssignmentService $assignmentService
     * @param $unitCode
     * @return JsonResponse
     */
    public function getAssignmentsByUnit(Request $request, AssignmentService $assignmentService, $unitCode): JsonResponse
    {
        try
        {
            return response()->json($assignmentService->getAssignmentsByUnit($unitCode),200);
        }
        catch (PeerAssessmentException $exception)
        {
            return response()->json($exception,400);
        }
    }

    /**
     * @param Request $request
     * @param AssignmentService $assignmentService
     * @param $unitCode
     * @return JsonResponse
     */
    public function getAssignmentOfferingsByUnit(Request $request, AssignmentService $assignmentService, $unitCode): JsonResponse
    {
        try
        {
            return response()->json($assignmentService->getAssignmentOfferingsByUnit($unitCode),200);
        }
        catch (PeerAssessmentException $exception)
        {
            return response()->json($exception,400);
        }
    }

    /**
     * @param Request $request
     * @param UserService $userService
     * @return JsonResponse
     * @throws JsonMapper_Exception
     */
    public function addStudentsToUnit(Request $request, UserService $userService)
    {
        $data = json_decode($request->getContent());
        $mapper = new JsonMapper();
        $addStudentsRequest = $mapper->map($data, new AddStudentsToUnitRequest());

        $userService->addStudentsToUnit($addStudentsRequest);

        return response()->json([],200);
    }

    /**
     * @param Request $request
     * @param UserService $userService
     * @param $unitCode
     * @return JsonResponse
     */
    public function studentsEnrolledIn(Request $request, UserService $userService, $unitCode): JsonResponse
    {
        try
        {
            return response()->json($userService->getStudentsForCurrentEnrollment($unitCode),200);
        }
        catch (PeerAssessmentException $exception) {
            return response()->json($exception, 400);
        }
    }
}
