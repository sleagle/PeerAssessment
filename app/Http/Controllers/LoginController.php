<?php

namespace App\Http\Controllers;

use App\DTO\Request\LoginRequest;
use App\Exceptions\PeerAssessmentException;
use App\Service\LoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonMapper;
use JsonMapper_Exception;
use function response;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @param LoginService $loginService
     * @return JsonResponse $response
     * @throws JsonMapper_Exception
     */
    public function login(Request $request, LoginService $loginService)
    {
        $data = json_decode($request->getContent());
        $mapper = new JsonMapper();
        $loginRequest = $mapper->map($data, new LoginRequest());

        try {
            return response()->json($loginService->validateUser($loginRequest),200);

        } catch (PeerAssessmentException $exception) {
            return response()->json($exception,401);
        }
    }
}
