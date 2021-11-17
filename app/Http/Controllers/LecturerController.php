<?php

namespace App\Http\Controllers;

use App\Exceptions\PeerAssessmentException;
use App\Service\LecturerService;
use App\Service\UnitService;
use App\Utility\Encryption;
use App\Utility\Utility;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonMapper_Exception;
use SodiumException;
use function response;

class LecturerController extends Controller
{
    /**
     * @param LecturerService $lecturerService
     * @return JsonResponse
     */
    public  function getAll(LecturerService $lecturerService): JsonResponse
    {
        return response()->json($lecturerService->getAllLecturers(),200);
    }

    /**
     * @param Request $request
     * @param UnitService $unitService
     * @return JsonResponse
     * @throws JsonMapper_Exception|SodiumException
     */
    public function getLecturerUnits(Request $request, UnitService $unitService): JsonResponse
    {
        $token = Utility::GetTokenFromRequest($request);

        try
        {
            return response()->json($unitService->getLecturerUnits((int)Encryption::GetUserID($token)),200);
        }
        catch (PeerAssessmentException $exception)
        {
            return response()->json($exception,400);
        }
    }
}
