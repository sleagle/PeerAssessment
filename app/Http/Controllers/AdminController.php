<?php

namespace App\Http\Controllers;

use App\DTO\Request\CreateUnitRequest;
use App\DTO\Request\CreateUserRequest;
use App\Service\LecturerService;
use App\Service\UnitService;
use App\Utility\Encryption;
use App\Utility\Utility;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonMapper;
use JsonMapper_Exception;
use function response;

class AdminController extends Controller
{
    public function createLecturer(Request $request, LecturerService $lecturerService)
    {
        $token = Utility::GetTokenFromRequest($request);
        if (Encryption::ValidateLoginToken($token, Utility::ADMIN_USER_TYPE)) {
            $data = json_decode($request->getContent());
            $mapper = new JsonMapper();

            $lecturer = $mapper->map($data, new CreateUserRequest());

            $lecturerId = $lecturerService->createLecturer($lecturer);

            $result = [
                'lecturer_Id' => $lecturerId
            ];

            return response()->json($result, 200);
        }
        else
        {
            return Utility::NotAuthorisedError();
        }
    }

    /**
     * @param Request $request
     * @param UnitService $unitService
     * @return JsonResponse
     * @throws JsonMapper_Exception
     */
    public function createUnit(Request $request, UnitService $unitService)
    {
        $token = Utility::GetTokenFromRequest($request);
        if (Encryption::ValidateLoginToken($token, Utility::ADMIN_USER_TYPE))
        {
            $data = json_decode($request->getContent());
            $mapper = new JsonMapper();
            $createUnitRequest = $mapper->map($data, new CreateUnitRequest());

            return response()->json($unitService->createUnit($createUnitRequest), 200);
        }
        else
        {
            return Utility::NotAuthorisedError();
        }
    }
}
